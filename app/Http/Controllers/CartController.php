<?php

namespace App\Http\Controllers;

use App\Helpers\General\EarningHelper;
use App\Http\Controllers\Services\JeelPayServices;
use App\Http\Controllers\Services\TabbyServices;
use App\Mail\OfflineOrderMail;
use App\Models\Bundle;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\CourseGroup;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Tax;
use App\Notifications\Frontend\PurchasedCourse;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PHPUnit\Framework\Constraint\Count;
use Stripe\Charge;
use Stripe\Stripe;
use App\Http\Controllers\Services\FatoorahServices;
use App\Models\CourseLocation;
use App\Http\Controllers\Traits\CheckUserFillData;
use App\UserInterests;
use Auth;

class CartController extends Controller
{

    private $path;
    private $currency;
    private $fatoorahServices;
    private $tabbyServices;
    private $jeelServices;

    use CheckUserFillData;


    public function __construct( FatoorahServices $fatoorahServices, TabbyServices $tabbyServices, JeelPayServices $jeelServices)
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        // $paypal_conf['client_id']='AXvDDQUMArVtS0tmFq-vsPFzF-Ub5JEaGD7X9FwsFZ3P39W5NnTajmpkb-4YwzFV8EIxojb16cXVSkox';
        // $paypal_conf['secret']='EEUQj6syRtjRtRYJFHCav3j261eob4XtQ2A02fmdEu7UKbNBaabe_VnWD43Ewx2lwhhzK8hKSZEYVykL';
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

        $path = 'frontend';
        if (session()->has('display_type')) {
            if (session('display_type') == 'rtl') {
                $path = 'frontend';
            } else {
                $path = 'frontend';
            }
        } else if (config('app.display_type') == 'rtl') {
            $path = 'frontend';
        }
        // if (session()->has('display_type')) {
        //     if (session('display_type') == 'rtl') {
        //         $path = 'frontend-rtl';
        //     } else {
        //         $path = 'frontend';
        //     }
        // } else if (config('app.display_type') == 'rtl') {
        //     $path = 'frontend-rtl';
        // }
        ///////////////////////
         if (session()->has('display_type')) {
            if (session('display_type') == 'rtl') {
                $path = 'frontend';
            } else {
                $path = 'frontend';
            }
        } else if (config('app.display_type') == 'rtl') {
            $path = 'frontend';
        }
        $this->path = $path;
        $this->currency = getCurrency(config('app.currency'));

        // //////Fatoorah Service/////
        $this->fatoorahServices=$fatoorahServices;

        // tabby srvice
        $this->tabbyServices =$tabbyServices;

        //jeel service
        $this->jeelServices =$jeelServices;

    }
    public function saveToInterests($course_id,$course_group_id){
        $user=auth()->user();
        $userInterest=UserInterests::where(['user_id'=>$user->id,'course_id'=>$course_id,'course_group_id'=>$course_group_id])->first();
        if($userInterest){
            $userInterest->visits=$userInterest->visits+1;
        }
        else{
            $userInterest=new UserInterests();
            $userInterest->user_id=$user->id;
            $userInterest->course_id=$course_id;
            $userInterest->course_group_id=$course_group_id;
            $userInterest->visits=1;
        }
        $userInterest->save();
    }
    public function removefromInterests($course_id,$course_group_id){
        $user=auth()->user();
        $userInterest=UserInterests::where(['user_id'=>$user->id,'course_id'=>$course_id,
            'course_group_id'=>$course_group_id])->first();
        if($userInterest){
            $userInterest->visits=$userInterest->visits-1;
            $userInterest->save();

        }
       
    }
    public function index(Request $request)
    {
       if (!Auth::user()){
           $cart_key = 'guest';
       }else {
           $cart_key = auth()->user()->id;
       }
        $ids = Cart::session($cart_key)->getContent()->keys();
        $course_ids = [];
        $bundle_ids = [];
        $course_location_ids=[];
        $course_group_ids=[];
        $course_location_currency=[];

        foreach (Cart::session($cart_key)->getContent() as $item) {
            if ($item->attributes->type == 'bundle') {
                $bundle_ids[] = $item->id;
            } else {
                $course_ids[] = $item->id;
//                $course_location_ids[]=CourseLocation::find($item->attributes->course_location_id);
                $course_group_ids[] = CourseGroup::find($item->attributes->course_group_id);
                $course_location_currency[]=$item->attributes->currency;
            }

        }
        $courses = new Collection(Course::find($course_ids));
        $bundles = Bundle::find($bundle_ids);
        $courses = $bundles->merge($courses);

        $total = $courses->sum('price');
        //Apply Tax
        $taxData = $this->applyTax('total');
        $message='';
        return view($this->path . '.cart.checkout-new', compact('courses', 'bundles', 'total', 'taxData','course_group_ids','course_location_currency','message'));
    }

    public function addToCart(Request $request)
    {
        $product = "";
        $teachers = "";
        $type = "";
        if ($request->has('course_id')) {
            $product = Course::findOrFail($request->get('course_id'));
            $teachers = $product->teachers->pluck('id', 'name');
            $type = 'course';

        } elseif ($request->has('bundle_id')) {
            $product = Bundle::findOrFail($request->get('bundle_id'));
            $teachers = $product->user->name;
            $type = 'bundle';
        }

        $cart_items = Cart::session(auth()->user()->id)->getContent()->keys()->toArray();
        if (!in_array($product->id, $cart_items)) {
            Cart::session(auth()->user()->id)
                ->add($product->id, $product->title, $product->price, 1,
                    [
                        'user_id' => auth()->user()->id,
                        'description' => $product->description,
                        'image' => $product->course_image,
                        'type' => $type,
                        'teachers' => $teachers,
                    ]);
            CartItem::create([
                'user_id' => auth()->user()->id,
                'course_id' => $product->id,
                'group_id' => $request->get('group_id'),
                'quantity' => 1
            ]);
        }

        Session::flash('success', trans('labels.frontend.cart.product_added'));
        return back();
    }

    public  function checkout(Request $request)
    {

        $product = "";
        $teachers = "";
        $type = "";
        $bundle_ids = [];
        $course_ids = [];
        $course_group_ids = [];
        $course_location_currency = [];
        $message='';
        $isEnrolled = false;


        if ($request->has('course_id')) {

            $product = Course::findOrFail($request->get('course_id'));
            $product->price=$request->get('amount');
            $product->currency=$request->get('currency');

            $teachers = $product->teachers->pluck('id', 'name');
            $type = 'course';
        } elseif ($request->has('bundle_id')) {
            $product = Bundle::findOrFail($request->get('bundle_id'));
           

            $teachers = $product->user->name;
            $type = 'bundle';
        }
        if(!Auth::user()){
           //add to cart session

            $cart_items = Cart::session('guest')->getContent()->keys()->toArray();
            $cart_items_all= Cart::session('guest')->getContent();
            $cart_items_currency = [];
            foreach ($cart_items_all as $key => $item) {
                $cart_items_currency[$key]=$item->attributes->currency;
            }
            $sameCurrency =true;
            if(count($cart_items_currency)>0){
                if(in_array($product->currency,$cart_items_currency))
                    $sameCurrency =true;
                else
                    $sameCurrency =false;
            }
            if (!in_array($product->id, $cart_items) &&$sameCurrency==true) {
                Cart::session('guest')
                    ->add($product->id, $product->title, $product->price, 1,
                        [
                            'user_id' => 0,
                            'description' => $product->description,
                            'image' => $product->course_image,
                            'type' => $type,
                            'teachers' => $teachers,
                            'course_group_id' => $request->get('group_id'),
                            'currency' => $product->currency
                        ]);


            }

            foreach (Cart::session('guest')->getContent() as $item) {
                if ($item->attributes->type == 'bundle') {
                    $bundle_ids[] = $item->id;
                } else {
                    $course_ids[] = $item->id;
                    $course_group_ids[] = CourseGroup::find($item->attributes->course_group_id);
                    $course_location_currency[]=$item->attributes->currency;
                }
            }
        }
        else{
            $isEnrolled = auth()->user()->groups()->whereHas('courses', function ($query) use ($request) {
                $query->where('id', $request->get('course_id'));
            })->exists();

            if ($isEnrolled) {
                // Return an error message
                return redirect()->back()->withErrors([__('alerts.frontend.dublicate_group')]);
            }
            $cart_items = Cart::session(auth()->user()->id)->getContent()->keys()->toArray();
            $cart_items_all= Cart::session(auth()->user()->id)->getContent();
            $cart_items_currency = [];
            foreach ($cart_items_all as $key => $item) {
                $cart_items_currency[$key]=$item->attributes->currency;
            }

            $sameCurrency =true;
            if(count($cart_items_currency)>0){
                if(in_array($product->currency,$cart_items_currency))
                    $sameCurrency =true;
                else
                    $sameCurrency =false;
            }
            if($product->price == null){
                $message=session('locale') =='ar'?'آسف لا يمكنك شراء هذه الدورة ، الرجاء التواصل مع الادارة':'sorry you cant buy this course please contact the administration';
                return back()->with('error',$message);
            }
            if (!in_array($product->id, $cart_items) &&$sameCurrency==true) {

                Cart::session(auth()->user()->id)
                    ->add($product->id, $product->title, $product->price, 1,
                        [
                            'user_id' => auth()->user()->id,
                            'description' => $product->description,
                            'image' => $product->course_image,
                            'type' => $type,
                            'teachers' => $teachers,
                            'course_group_id' => $request->get('group_id'),
                            'currency' => $product->currency
                        ]);
                //add to cart items
                CartItem::create([
                    'user_id' => auth()->user()->id,
                    'course_id' => $product->id,
                    'group_id' => $request->get('group_id'),
                    'quantity' => 1
                ]);
            }

            foreach (Cart::session(auth()->user()->id)->getContent() as $item) {

                if ($item->attributes->type == 'bundle') {
                    $bundle_ids[] = $item->id;
                } else {
                    $course_ids[] = $item->id;
                    $course_group_ids[] = CourseGroup::find($item->attributes->course_group_id);
                    //                $course_location_ids[]=CourseLocation::find($item->attributes->course_location_id);
                    $course_location_currency[]=$item->attributes->currency;
                    $this->saveToInterests($item->id,$item->attributes->course_group_id);
                }
            }
        }

       
        $courses = new Collection(Course::find($course_ids));
        $bundles = new Collection( Bundle::find($bundle_ids));
       
        $courses = $bundles->merge($courses);
        
     
                                                                        
        $total = $courses->sum('price');

        //Apply Tax
        $taxData = $this->applyTax('total');

        if($sameCurrency==false){
            $message=session('locale') =='ar'?'آسف لا يمكنك شراء هذه الدورة ، عربة التسوق الخاصة بك ممتلئة بدورات بعملات مختلفة':'sorry you cant buy this course your cart is fill of course with differant currency';
       
        }
        if ($request->is_add_to_cart == 1) {
            //return json with course name, id, img and group name, id, price, currency
            $group = CourseGroup::find($request->get('group_id'));

            $data = [
                'course_name' => $group->courses->title,
                'course_id' => $group->courses->id,
                'course_img' => ($group->courses->course_image) ? $group->courses->course_image : '',
                'group_name' => (app()->getLocale() == 'ar') ? $group->title_ar : $group->title,
                'group_id' => $group->id,
                'price' => $group->price,
                'currency' => $product->currency,
            ];
            return response()->json($data);
        }
        return view($this->path . '.cart.checkout-new', compact('courses', 'total', 'taxData','course_group_ids','course_location_currency','message'));
    }

    public function clear(Request $request)
    {
        if (!Auth::user()){
            $cart_key = 'guest';
        }else {
            $cart_key = auth()->user()->id;
        }
        Cart::session($cart_key)->clear();
        return back();
    }

    public function remove(Request $request)
    {
        if (!Auth::user()){
            $cart_key = 'guest';
        }else {
            $cart_key = auth()->user()->id;
        }
        Cart::session($cart_key)->removeConditionsByType('coupon');

        if (Cart::session($cart_key)->getContent()->count() < 2) {
            Cart::session($cart_key)->clearCartConditions();
            Cart::session($cart_key)->removeConditionsByType('tax');
            Cart::session($cart_key)->removeConditionsByType('coupon');
            Cart::session($cart_key)->clear();
        }
        Cart::session($cart_key)->remove($request->course);
       
        return redirect()->route('cart.index');
    }

    public function stripePayment(Request $request)
    {
        if ($this->checkDuplicate()) {
            return $this->checkDuplicate();
        }
        //Making Order
        $order = $this->makeOrder();

        //Charging Customer
        $status = $this->createStripeCharge($request);

        if ($status == 'success') {
            $order->status = 1;
            $order->payment_type = 1;
            $order->save();
            (new EarningHelper)->insert($order);
            foreach ($order->items as $orderItem) {
                //Bundle Entries
                if ($orderItem->item_type == Bundle::class) {
                    foreach ($orderItem->item->courses as $course) {
                        $course->students()->attach($order->user_id);
                    }
                }
                $orderItem->item->students()->attach($order->user_id);
            }

            //Generating Invoice
            generateInvoice($order);

            Cart::session(auth()->user()->id)->clear();
            return redirect()->route('status');

        } else {
            $order->status = 2;
            $order->save();
            return redirect()->route('cart.index');
        }
    }

 
    public function paypalPayment(Request $request)
    {
        if ($this->checkDuplicate()) {
            return $this->checkDuplicate();
        }
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $items = [];

        $cartItems = Cart::session(auth()->user()->id)->getContent();
        $cartTotal = Cart::session(auth()->user()->id)->getTotal();
        $currency = $this->currency['short_code'];

        foreach ($cartItems as $cartItem) {

            $item_1 = new Item();
            $item_1->setName($cartItem->name) /** item name **/
                ->setCurrency($currency)
                ->setQuantity(1)
                ->setPrice($cartItem->price);
            /** unit price **/
            $items[] = $item_1;
        }

        $item_list = new ItemList();
        $item_list->setItems($items);

        $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($cartTotal);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription(auth()->user()->name);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('cart.paypal.status')) /** Specify return URL **/
            ->setCancelUrl(URL::route('cart.paypal.status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('failure', trans('labels.frontend.cart.connection_timeout'));
                return Redirect::route('cart.paypal.status');
            } else {
                \Session::put('failure', trans('labels.frontend.cart.unknown_error'));
                return Redirect::route('cart.paypal.status');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('failure', trans('labels.frontend.cart.unknown_error'));
        return Redirect::route('cart.paypal.status');
    }

    public function offlinePayment(Request $request)
    {
       
        
        if ($this->checkDuplicate()) {
            return $this->checkDuplicate();
        }

        // /save receipt
        $filename='';
        if($request->file('bank_transfer_receipt')){
            $extension = array_last(explode('.', $request->file('bank_transfer_receipt')->getClientOriginalName()));
            $name = array_first(explode('.', $request->file('bank_transfer_receipt')->getClientOriginalName()));
            $filename = time() . '-' . str_slug($name) . '.' . $extension;
            $request->file('bank_transfer_receipt')->move(public_path('storage/receipts'), $filename);
        }
        //    /////////////////////////////////////
        //Making Order
        $order = $this->makeOrder();
      
        
        $order->payment_type = 3;
        $order->bank_transfer_receipt = $filename;
        $order->status = 0;
        $order->save();
        $content = [];
        $items = [];
        $counter = 0;
        foreach (Cart::session(auth()->user()->id)->getContent() as $key => $cartItem) {
            
            $counter++;
            $location=CourseLocation::find($cartItem->attributes->course_location_id);
            $locName=$location?$location->name:'';
            array_push($items, ['number' => $counter, 'name' => $cartItem->name, 'price' => $cartItem->price,'location'=>$locName]);
        }

        $content['items'] = $items;
        $content['total'] = Cart::session(auth()->user()->id)->getTotal();
        $content['reference_no'] = $order->reference_no;

        try {
            \Mail::to(auth()->user()->email)->send(new OfflineOrderMail($content));
        } catch (\Exception $e) {
            \Log::info($e->getMessage() . ' for order ' . $order->id);
        }

        Cart::session(auth()->user()->id)->clear();
        \Session::flash('success', trans('labels.frontend.cart.offline_request'));
        return redirect()->route('courses.all');
    }

    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('failure', trans('labels.frontend.cart.payment_failed'));
            return Redirect::route('status');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $order = $this->makeOrder();
        $order->payment_type = 2;
        $order->save();
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            \Session::flash('success', trans('labels.frontend.cart.payment_done'));
            $order->status = 1;
            $order->save();
            (new EarningHelper)->insert($order);
            foreach ($order->items as $orderItem) {
                //Bundle Entries
                if ($orderItem->item_type == Bundle::class) {
                    foreach ($orderItem->item->courses as $course) {
                        $course->students()->attach($order->user_id);
                    }
                }
                $orderItem->item->students()->attach($order->user_id);
            }

            //Generating Invoice
            generateInvoice($order);
            Cart::session(auth()->user()->id)->clear();
            return Redirect::route('status');
        } else {
            \Session::flash('failure', trans('labels.frontend.cart.payment_failed'));
            $order->status = 2;
            $order->save();
            return Redirect::route('status');
        }

    }

    public function getNow(Request $request)
    {
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->reference_no = str_random(8);
        $order->amount = 0;
        $order->status = 1;
        $order->payment_type = 0;
        $order->save();
        //Getting and Adding items
        if ($request->course_id) {
            $type = Course::class;
            $id = $request->course_id;
        } else {
            $type = Bundle::class;
            $id = $request->bundle_id;

        }
        $order->items()->create([
            'item_id' => $id,
            'item_type' => $type,
            'price' => 0,
            'item_group_id'=>isset($request->course_group_id)?$request->course_group_id:null
        ]);

        foreach ($order->items as $orderItem) {
            //Bundle Entries
            
            if ($orderItem->item_type == Bundle::class) {
                
                foreach ($orderItem->item->courses as $course) {
                    $course->students()->attach($order->user_id);
                }
            }
            $orderItem->item->students()->attach($order->user_id);
        }
        Session::flash('success', trans('labels.frontend.cart.purchase_successful'));
        return back();

    }

    public function getOffers()
    {
        $coupons = Coupon::where('status', '=', 1)->get();
        return view('frontend.cart.offers', compact('coupons'));
    }

    public function applyCoupon(Request $request)
    {
        if (!Auth::user()){
            $cart_key = 'guest';
            return ['status' => 'fail', 'message' => 'Must be logged in'];
        }else {
            $cart_key = auth()->user()->id;
        }

        Cart::session($cart_key)->removeConditionsByType('coupon');

        $coupon = $request->coupon;
        $coupon = Coupon::where('code', '=', $coupon)
            ->where('status', '=', 1)
            ->first();
        if ($coupon != null) {
            Cart::session($cart_key)->clearCartConditions();
            Cart::session($cart_key)->removeConditionsByType('coupon');
            Cart::session($cart_key)->removeConditionsByType('tax');

            $ids = Cart::session($cart_key)->getContent()->keys();
            $course_ids = [];
            $bundle_ids = [];
            foreach (Cart::session($cart_key)->getContent() as $item) {
                if ($item->attributes->type == 'bundle') {
                    $bundle_ids[] = $item->id;
                } else {
                    $course_ids[] = $item->id;
                    $group_ids[] = $item->attributes->course_group_id;
                }
            }
            $courses = new Collection(Course::find($course_ids));
            $bundles = Bundle::find($bundle_ids);
            $courses = $bundles->merge($courses);
            $groups = CourseGroup::find($group_ids);
            $course_location_currency = [];

            foreach ($groups as $group) {
                // Assuming $group is an object and has a currency attribute
                if (!in_array($group->currency, $course_location_currency)) {
                    $course_location_currency[] = $group->currency;
                }
            }

            $total = $groups->sum('price');
            $isCouponValid = false;
            if ($coupon->useByUser() < $coupon->per_user_limit) {
                $isCouponValid = true;
                if (($coupon->min_price != null) && ($coupon->min_price > 0)) {
                    if ($total >= $coupon->min_price) {
                        $isCouponValid = true;
                    }
                } else {
                    $isCouponValid = true;
                }
                if ($coupon->expires_at != null) {
                    if (Carbon::parse($coupon->expires_at) >= Carbon::now()) {
                        $isCouponValid = true;
                    } else {
                        $isCouponValid = false;
                    }
                }

            }

            if ($isCouponValid == true) {
                $type = null;
                if ($coupon->type == 1) {
                    $type = '-' . $coupon->amount . '%';
                } else {
                    $type = '-' . $coupon->amount;
                }

                $condition = new \Darryldecode\Cart\CartCondition(array(
                    'name' => $coupon->code,
                    'type' => 'coupon',
                    'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                    'value' => $type,
                    'order' => 1,
                ));

                Cart::session($cart_key)->condition($condition);
                //Apply Tax
                $taxData = $this->applyTax('subtotal');

                $html = view('frontend.cart.partials.order-stats', compact('total', 'taxData', 'course_location_currency'))
                    ->render();
                return ['status' => 'success', 'html' => $html];
            }

        }
        return ['status' => 'fail', 'message' => trans('labels.frontend.cart.invalid_coupon')];
    }

    public function removeCoupon(Request $request)
    {

        Cart::session(auth()->user()->id)->clearCartConditions();
        Cart::session(auth()->user()->id)->removeConditionsByType('coupon');
        Cart::session(auth()->user()->id)->removeConditionsByType('tax');

        $course_ids = [];
        $bundle_ids = [];
        foreach (Cart::session(auth()->user()->id)->getContent() as $item) {
            if ($item->attributes->type == 'bundle') {
                $bundle_ids[] = $item->id;
            } else {
                $course_ids[] = $item->id;
            }
        }
        $courses = new Collection(Course::find($course_ids));
        $bundles = Bundle::find($bundle_ids);
        $courses = $bundles->merge($courses);

        $total = $courses->sum('price');

        //Apply Tax
        $taxData = $this->applyTax('subtotal');

        $html = view('frontend.cart.partials.order-stats', compact('total', 'taxData'))->render();
        return ['status' => 'success', 'html' => $html];

    }

    private function makeOrder($payment_type=0)
    {

        $coupon = Cart::session(auth()->user()->id)->getConditionsByType('coupon')->first();
        if ($coupon != null) {
            $coupon = Coupon::where('code', '=', $coupon->getName())->first();
        }

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->reference_no = str_random(8);
        $order->amount = Cart::session(auth()->user()->id)->getTotal();
        $order->status = 1;
        $order->coupon_id = ($coupon == null) ? 0 : $coupon->id;
        $order->payment_type = $payment_type;
        // $order->payment_type = 3;
        $order->save();

        //Getting and Adding items
        foreach (Cart::session(auth()->user()->id)->getContent() as $cartItem) {
            
            if ($cartItem->attributes->type == 'bundle') {
                $type = Bundle::class;
            } else {
                $type = Course::class;
            }
            $order->items()->create([
                'item_id' => $cartItem->id,
                'item_type' => $type,
                'price' => $cartItem->price,
                'item_group_id'=>$cartItem->attributes->course_group_id,
            ]);
        }
//        Cart::session(auth()->user()->id)->removeConditionsByType('coupon');
        return $order;
    }

    private function checkDuplicate()
    {
        $is_duplicate = false;
        $message = '';
        $orders = Order::where('user_id', '=', auth()->user()->id)->pluck('id');
        $order_items = OrderItem::whereIn('order_id', $orders)->with('order')->get(['item_id', 'item_type',
            'item_group_id','order_id']);
      
        foreach (Cart::session(auth()->user()->id)->getContent() as $cartItem) {
            if ($cartItem->attributes->type == 'course') {
                foreach ($order_items->where('item_type', 'App\Models\Course') as $item) {
                    
                    if ($item->item_id == $cartItem->id && $item->item_group_id ==
                        $cartItem->attributes->course_location_id && ($item->order&&($item->order->status==0||$item->order->status==1))) {
                        $is_duplicate = true;
                        $message .= $cartItem->name . ' ' . __('alerts.frontend.duplicate_course') ;
                    }
                }
            }
            if ($cartItem->attributes->type == 'bundle') {
                foreach ($order_items->where('item_type', 'App\Models\Bundle') as $item) {
                    if ($item->item_id == $cartItem->id) {
                        $is_duplicate = true;
                        $message .= $cartItem->name . '' . __('alerts.frontend.duplicate_bundle') ;
                    }
                }
            }
        }

        if ($is_duplicate) {
            
            \Session::flash('error', trans($message));
            return redirect('cart')->withdanger($message);
        }
        return false;

    }

    private function createStripeCharge($request)
    {
        $status = "";
        Stripe::setApiKey(config('services.stripe.secret'));
        $amount = Cart::session(auth()->user()->id)->getTotal();
        $currency = $this->currency['short_code'];
        try {
            Charge::create(array(
                "amount" => $amount * 100,
                "currency" => strtolower($currency),
                "source" => $request->reservation['stripe_token'], // obtained with Stripe.js
                "description" => auth()->user()->name,
            ));
            $status = "success";
            Session::flash('success', trans('labels.frontend.cart.payment_done'));
        } catch (\Exception $e) {
            \Log::info($e->getMessage() . ' for id = ' . auth()->user()->id);
            Session::flash('failure', trans('labels.frontend.cart.try_again'));
            $status = "failure";
        }
        return $status;
    }

    private function applyTax($target)
    {
        //Apply Conditions on Cart
        $taxes = Tax::where('status', '=', 1)->get();
        if(!Auth::user()){
            Cart::session('guest')->removeConditionsByType('tax');
        }else{
            Cart::session(auth()->user()->id)->removeConditionsByType('tax');
        }
        if ($taxes != null) {
            $taxData = [];
            foreach ($taxes as $tax) {
                if(!Auth::user()){
                    $total = Cart::session('guest')->getTotal();
                }else{
                    $total = Cart::session(auth()->user()->id)->getTotal();
                }
                $taxData[] = ['name' => '+' . $tax->rate . '% ' . $tax->name, 'amount' => $total * $tax->rate / 100];
            }

            $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'Tax',
                'type' => 'tax',
                'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                'value' => $taxes->sum('rate') . '%',
                'order' => 2,
            ));
            if(!Auth::user()){
                Cart::session('guest')->condition($condition);
            }else{
                Cart::session(auth()->user()->id)->condition($condition);
            }
            return $taxData;
        }
    }


// /////////////////fatoorahPayment Integrate with MyFatoorah service/////
    public function fatoorahPayment(Request $request)
    {
       
        // //////Requierd fields///////////////////////////////////////
        // 'InvoiceValue' => Number,                                  #
        // 'CustomerName' => 'fname lname',                           #
        // 'NotificationOption' => "LNK",//or SMS or ...etc           #
        // 'MobileCountryCode'  => '+20',or +966 or ...etc            #
        // 'CustomerMobile' => '1000952470',                          #
        // 'CustomerEmail' => 'mail string',                          #
        // 'CallBackUrl' => 'succsess return url                      #
        // 'ErrorUrl' => 'failuar url,                                #
        // 'Language' => 'EN',                                        #
        // 'DisplayCurrencyIso' => 'SAR',                             #
        // ////////////////////////////////////////////////////////////

       
        if ($this->checkDuplicate()) {
            return $this->checkDuplicate();
        }
        $cartItems = Cart::session(auth()->user()->id)->getContent();
        $cartTotal = Cart::session(auth()->user()->id)->getTotal();
        $cartSubTotal = Cart::session(auth()->user()->id)->getSubTotal();
        $currency = $this->currency['short_code'];
        $user=auth()->user();
        // $CallBackUrl='https://www.myfatoorah.com';
        // $ErrorUrl='https://www.google.com';
        $CallBackUrl=URL::to('/cart/fatoorahSuccess');
        $ErrorUrl=URL::to('/cart/fatoorahFail');


        $Items=[];
        foreach ($cartItems as $key => $item) {
            # code...
            $group = CourseGroup::find($item->attributes->course_group_id);

            $item=[
                'ItemName'=>$item->name.'('.$group->title_en.')',
                'Quantity'=>'1',
                'UnitPrice'=>$item->price,
            ];

            $Items[]=$item;
            $FatoorahCurrency=$group->currency=='dollar'?'USD':'SAR';

        }

        // Get Coupons
        $coupon = Cart::session(auth()->user()->id)->getConditionsByType('coupon')->first();
        if ($coupon != null) {
            // Get coupon amount
            $coupon = Coupon::where('code', '=', $coupon->getName())->first();

            // Percentage type
            if ($coupon->type == 1) {
                $discountAmount = $cartSubTotal * ($coupon->amount / 100);
            } else { // Fixed amount type
                $discountAmount = $coupon->amount;
            }

            // Add discount item
            $item = [
                'ItemName' => 'Discount ('.$coupon->code.')',
                'Quantity'=> '1',
                'UnitPrice'=> -$discountAmount,
            ];
            $Items[] = $item;
        }

        // Get Tax
        $tax = Cart::session(auth()->user()->id)->getConditionsByType('tax')->first();
        if ($tax != null) {
            // Get tax amount
            $taxAmount = $tax->parsedRawValue;

            // Add tax item
            $item = [
                'ItemName' => 'Tax',
                'Quantity'=> '1',
                'UnitPrice'=> $taxAmount,
            ];
            $Items[] = $item;
        }

        $data = [
            'InvoiceValue' => $cartTotal ,
            'CustomerName' => $user->name_ar.' '.$user->second_name_ar.' '.$user->third_name_ar.' '.$user->fourth_name_ar,
            'NotificationOption' => "LNK",
            'CustomerEmail' => $user->email,
            'CallBackUrl' => $CallBackUrl,
            'ErrorUrl' => $ErrorUrl,
            'InvoiceItems'=>$Items,
            'Language' => 'EN',
            // 'DisplayCurrencyIso' => 'SAR',
            'DisplayCurrencyIso' => $FatoorahCurrency,


        ];

        // Store payment method in session just before redirecting
        Session::put('payment_method', 'fatoorah');

        $response=$this->fatoorahServices->sendPayment($data);

        if(gettype($response)!='string'){
            if($response['IsSuccess']==true){

                return redirect($response['Data']['InvoiceURL']);

            }
        } else{
            $response=json_decode($response);
            return redirect('cart')->with('error',$response->Message);
        }
    }

    /////fatoorah redierct function if payed success
    public function fatoorahSuccess(Request $request)
    {
        // Retrieve payment method from session
        $paymentMethod = Session::get('payment_method', 'default');

        // Determine payment type based on the payment method
        $paymentType = 3; // Default payment type
        if ($paymentMethod == 'tabby') {
            $paymentType = 5; // Payment type for Tabby Pay
        } elseif ($paymentMethod == 'fatoorah') {
            $paymentType = 4; // Payment type for Fatoorah
        } elseif ($paymentMethod == 'jeel'){
            $paymentType = 6; // Payment type for Jeel Pay
        }

          //Making Order
          $order = $this->makeOrder($paymentType);
            Session::flash('success', trans('labels.frontend.cart.payment_done'));
            $order->status = 1;
            $order->payment_type = $paymentType;

            if ($request->has('callback_type') && $request->callback_type == 'jeel'){
                $callback = $request->callback_id;
                $order->jeel_callbacks()->create([
                    'payment_request_id' => $callback
                ]);
            }
            $order->save();

            $items=[];
            (new EarningHelper)->insert($order);
            foreach ($order->items as $orderItem) {
                $group = CourseGroup::find($orderItem->item_group_id);
                //Bundle Entries
                if ($orderItem->item_type == Bundle::class) {
                    # student
                    foreach ($orderItem->item->courses as $course) {
                        // $course->students()->attach($order->user_id);
//                        $first_location_id=$course->locations->first()?$course->locations->first()->pivot->id:0;
//                        $course->students()->attach($order->user_id,['course_location_id'=>$first_location_id]);
                        $group->students()->attach($order->user_id);
                    }
                    $orderItem->item->students()->attach($order->user_id);
                }
                else{
                    $course = $orderItem->item;
                        // $course->students()->attach($order->user_id);
//                    $first_location_id=$course->locations->first()?$course->locations->first()->pivot->id:0;
//                    $course->students()->attach($order->user_id,['course_location_id'=>$first_location_id]);
                    $group->students()->attach($order->user_id);

                    $this->removefromInterests($orderItem->item_id,$orderItem->item_group_id);
                }
           
            }

            //Generating Invoice
            generateInvoice($order);
         
            Cart::session(auth()->user()->id)->clear();

            // Notify User
             auth()->user()->notify(new PurchasedCourse());
            Session::forget('payment_method');

            return redirect()->route('status');

       
    }

    public function fatoorahFail(Request $request)
    {
        // Retrieve payment method from session
        $paymentMethod = Session::get('payment_method', 'default');

        // Determine payment type based on the payment method
        $paymentType = 3; // Default payment type
        if ($paymentMethod == 'tabby') {
            $paymentType = 5; // Payment type for Tabby Pay
        } elseif ($paymentMethod == 'fatoorah') {
            $paymentType = 4; // Payment type for Fatoorah
        } elseif ($paymentMethod == 'jeel'){
            $paymentType = 6; // Payment type for Jeel Pay
        }

        $order = $this->makeOrder();
        \Session::flash('failure', trans('labels.frontend.cart.payment_failed'));
        $order->status = 2;
        $order->payment_type = $paymentType;
        $order->save();
        return Redirect::route('status');

        return redirect('/cart')->with('error', 'Error in Paid course');    
    }

    
    public function tabbyPayment(Request $request)
    {
        //check if the user has filled his data

        if (!auth()->user()->IsUserFilledData()){
            return redirect()->route('admin.account')->withFlashDanger(__('alerts.backend.users.update_your_info'));
        }
        if ($this->checkDuplicate()) {
            return $this->checkDuplicate();
        }
        $cartItems = Cart::session(auth()->user()->id)->getContent();
        $cartTotal = Cart::session(auth()->user()->id)->getTotal();
        $currency = $this->currency['short_code'];
        $user=auth()->user();
        $successUrl=URL::to('/cart/fatoorahSuccess');
        $errorUrl=URL::to('/cart/fatoorahFail');
        $Items=[];
        foreach ($cartItems as $key => $item) {
            $group = CourseGroup::find($item->attributes->course_group_id);
            $item=[
                'title'=>$item->name.'('.$group->title_en.')',
                'description' => $item->title_en,
                'quantity'=> 1,
                'unit_price'=>$item->price,
                'category'=>$group->courses->title,
            ];

            $Items[] = $item;
            $gCurrency = $group->currency == 'dollar' ? 'USD' : 'SAR';
        }

        $data = [
          'payment' => [
            'amount' => $cartTotal,
            'currency' => $gCurrency,
            "description"=> "paying course",
            'buyer' => [
              'name' => (app()->getLocale() == 'ar') ? $user->full_name_ar : $user->full_name,
              'email' => $user->email,
              'phone' => $user->phone,
//              'dob' => "2005-07-21"
            ],
//            'shipping_address'=>[
//                  'city' => "Egypt",
//                  'address' => "Egypt",
//                  'zip' => "Egypt",
//              ],
            'order' => [
                "tax_amount" => "0.00",
                "shipping_amount" => "0.00",
                "discount_amount" => "0.00",
                "updated_at" =>str_replace('p','Z',date('Y-m-d\TH:i:sp')),
                'items' => $Items,
                'reference_id' => "qw",
                ],
              'meta' => [
                  'order_id' => "RCPT-12",
                  'reference_id' => $user->id,
              ],
//            'buyer_history' => [
//                'registered_since' => str_replace('p','Z',date('Y-m-d\TH:i:sp')),
//                'loyalty_level' => 0
//                ],
//            'order_history' =>[
//                [
//                    'purchased_at' => str_replace('p','Z',date('Y-m-d\TH:i:sp')),
//                    'amount' => $cartTotal,
//                    'status' => 'new',
//                    'buyer' => [
//                        'name' => $user->full_name_ar,
//                        'email' => $user->email,
//                        'phone' => $user->phone,
//                    ],
//                    'shipping_address'=>[
//                        'city' => $user->country,
//                        'address' => $user->city,
//                        'zip' => "12599",
//                    ],
//                ]
//            ]
          ],
          'lang' => app()->getLocale(),
          'merchant_code'=>'SlvrIvory',
          'merchant_urls' => [
            'success' => $successUrl,
            'cancel' => $errorUrl,
            'failure' => $errorUrl,
          ],
//          "token" => null,
//            "customer" =>[
//                'phone' => "01224911258",
//                'code' => "0020"
//            ]
        ];
//        dd($data);

        // Store payment method in session just before redirecting
        Session::put('payment_method', 'tabby');

        $response = $this->tabbyServices->sendPayment($data);

//        dd($response);
        if ($response['status'] == 'created') {
            return redirect($response['configuration']['available_products']['installments'][0]['web_url']);
        } else {
            return redirect('cart')->with('error', $response['status']);
        }
    }

    public function jeelPayment(Request $request)
    {

        //check if the user has filled his data
        if (!auth()->user()->IsUserFilledData()){
            return redirect()->route('admin.account')->withFlashDanger(__('alerts.backend.users.update_your_info'));
        }
        if ($this->checkDuplicate()) {
            return $this->checkDuplicate();
        }
        // Get cart content
        $cartItems = Cart::session(auth()->user()->id)->getContent();

        // Get cart total
        $cartTotal = Cart::session(auth()->user()->id)->getTotal();

        // Get the current user
        $user = auth()->user();

        // Initialize Callback URL
        $callback = URL::to('/cart/jeel/callback');

        // Initialize items array
        $Items=[];

        // Loop through cart items
        foreach ($cartItems as $key => $item) {
            $group = CourseGroup::find($item->attributes->course_group_id);
            $item=[
                'title'=>$item->name.'('.$group->title_en.')',
                'description' => $item->title_en,
                'quantity'=> 1,
                'unit_price'=>$item->price,
                'category'=>$group->courses->title,
            ];
            // Add item to items array
            $Items[] = $item;
            $gCurrency = $group->currency == 'dollar' ? 'USD' : 'SAR';
        }

        // Store payment method in session just before redirecting
        Session::put('payment_method', 'jeel');

        // Remove leading 00966 or +966 from phone number
        $phone_number = preg_replace('/^00966/', '', $user->phone);
        $phone_number = preg_replace('/^\+966/', '', $phone_number);
        $phone_number = preg_replace('/^966/', '', $phone_number);

        // Check if number format is correct (starts with 5 and consist of 9 digits)
        if (!preg_match('/^5[0-9]{8}$/', $phone_number)) {
            return redirect('cart')->with('error', __('alerts.frontend.payment.invalid_phone_number'));
        }

        // Check if national id format is correct (starts with 1 or 2 and consist of 10 digits)
        if (!preg_match('/^[1-2][0-9]{9}$/', $user->national_id_number)) {
            return redirect('cart')->with('error', __('alerts.frontend.payment.invalid_national_id'));
        }

        // Initialize data needed to check user eligibility
        $eligible_data = [
          'mobileNumber' => $phone_number,
          'cost' => $cartTotal,
        ];

        // Check user installment eligibility
        $eligible = $this->jeelServices->checkEligibility($eligible_data);

        // If user is eligible, send checkout request
        if (array_key_exists('eligible',$eligible)) {

            // Initialize data needed to send checkout request
            $checkout_data = [
                'school_name' => 'شركة تمهير للتدريب',
                'customer' => [
                    'first_name' => app()->getLocale() == 'ar' ? $user->name_ar : $user->last_name,
                    'last_name' => app()->getLocale() == 'ar'  ? $user->sec_name_ar : $user->sec_name_ar,
                    'phone_number' => $phone_number,
                    'national_id' => $user->national_id_number,
                    'email' => $user->email,
                ],
                'students' => [
                    [
                        'national_id' => $user->national_id_number,
                        'entity_id' => config('jeel.entity_id_test'),
                        'previous_costs' => 0,
                        'academic_year' => '2025',
                        'is_currently_enrolled' => true,
                        'name' => app()->getLocale() == 'ar' ? $user->full_name_ar : $user->full_name,
                        'cost' => $cartTotal,
                        'grade' => '12',
                    ],
                ],
                'urls' => [
                    'redirect_url' => $callback,
                    'notification_url' => $callback,
                ],
            ];

            // Send Payment
            $response = $this->jeelServices->sendPayment($checkout_data);
            if (array_key_exists('redirect_url', $response)) {
                return redirect($response['redirect_url']);
            }
            else {
                foreach($response['response']['errors'] as $error){
                    switch ($error['id']) {
                        case 'INST-REQ-006':
                            return redirect('cart')->with('error', __('alerts.frontend.payment.phone_registered_with_another_id'));
                        case 'INST-REQ-008':
                            return redirect('cart')->with('error', __('alerts.frontend.payment.has_open_request'));
                        case 'INST-REQ-013':
                            return redirect('cart')->with('error', __('alerts.frontend.payment.past_due_claims'));
                        case 'PLAN-010':
                            return redirect('cart')->with('error', __('alerts.frontend.payment.plan_cost_not_acceptable'));
                        case 'INST-REQ-014':
                            return redirect('cart')->with('error', __('alerts.frontend.payment.entity_not_belong_to_group'));
                        case 'INST-REQ-015':
                            return redirect('cart')->with('error', __('alerts.frontend.payment.entity_no_active_contract'));
                        case 'INST-REQ-016':
                            return redirect('cart')->with('error', __('alerts.frontend.payment.contract_no_open_balances'));
                        case 'INST-REQ-017':
                            return redirect('cart')->with('error', __('alerts.frontend.payment.entity_balance_consumed'));
                        case 'INST-REQ-018':
                            return redirect('cart')->with('error', __('alerts.frontend.payment.group_no_entities'));
                        case 'INST-REQ-021':
                            return redirect('cart')->with('error', __('alerts.frontend.payment.installment_exceeds_max_limit'));
                        case 'INST-REQ-022':
                            return redirect('cart')->with('error', __('alerts.frontend.payment.installment_below_limit'));
                        default:
                            return redirect('cart')->with('error', __('alerts.frontend.payment.something_went_wrong'));
                    }
                }

            }
        }

        return redirect('cart')->with('error', __('alerts.frontend.payment.not_eligible'));
    }

    public function jeelSuccess(Request $request)
    {
        // Extract data from the callback
        $requestId = $request->input('requestId', null);
        $id = $request->input('id');
        $status = $request->input('status');

        // Handle different statuses
        switch ($status) {
            case 'SUBMITTED':
                // Handle newly created installment request
                return redirect('cart')->with('error', __('alerts.frontend.payment.status.submitted'));
            case 'CUSTOMER_APPROVED':
                // Handle user acceptance of the agreement
                return redirect('cart')->with('error', __('alerts.frontend.payment.status.customer_approved'));
            case 'CUSTOMER_REJECTED':
                // Handle user rejection of the agreement
                return redirect()->route('cart.fatoorah.fail');
            case 'CUSTOMER_CANCELLED':
                // Handle user cancellation of the request
                return redirect()->route('cart.fatoorah.fail');
            case 'EXPIRED':
                // Handle expired installment request
                return redirect('cart')->with('error', __('alerts.frontend.payment.status.expired'));
            case 'SUCCEEDED':
                // Handle successful installment request
                return redirect()->route('cart.fatoorah.success', ['callback_type' => 'jeel', 'callback_id' => $requestId]);
            default:
                return redirect('cart')->with('error', __('alerts.frontend.payment.something_went_wrong'));
        }

        // Return a response
        return response()->json(['message' => 'Callback handled successfully']);
    }

}
