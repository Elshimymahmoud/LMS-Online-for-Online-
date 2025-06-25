<?php

use App\Helpers\General\Timezone;
use App\Helpers\General\HtmlHelper;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS2D;

/*
 * Global helpers file with misc functions.
 */

if (!function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (!function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (!function_exists('save_pdf')) {
    /**
     * Access the gravatar helper.
     */

    function save_pdf($html_url, $certificate_name)
    {
        $apiKey="api_44EFDA7294074588A62E28AF3228FB38";
        // $url = "https://api.sejda.com/v2/html-pdf";
        // $content = json_encode(array('url' => $html_url,'pageSize'=>'1203x854px'));

        // $curl = curl_init($url);
        // curl_setopt($curl, CURLOPT_HEADER, false);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        // "Content-type: application/json",
        // "Authorization: Token: " . $apiKey));
        // curl_setopt($curl, CURLOPT_POST, true);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        // $response = curl_exec($curl);

        // $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);


        // if ($status == 200) {
        //     dd($status);
        // $save_loaction=public_path('storage/certificates/' . $certificate_name);
        // $fp = fopen($save_loaction, "w");
        // fwrite($fp, $response);
        // fclose($fp);

        // } else {

        // print("Error: failed with status $status, response $response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        // }
        $url = "https://api.sejda.com/v2/html-pdf";
        $content = json_encode(array('url' => $html_url,'pageSize'=>'1203x854px'));

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Content-type: application/json",
            "Authorization: Token: " . $apiKey
        ));

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($status == 200) {
            $fp = fopen("out.pdf", "w");
            fwrite($fp, $response);
            fclose($fp);
            print("PDF saved to disk");
        } else {
            print("Error: failed with status $status, response $response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }
    }
}

if (!function_exists('timezone')) {
    /**
     * Access the timezone helper.
     */
    function timezone()
    {
        return resolve(Timezone::class);
    }
}

if (!function_exists('include_route_files')) {

    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function include_route_files($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (!function_exists('home_route')) {

    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function home_route()
    {
        if (auth()->check()) {
            if (auth()->user()->can('view backend') && auth()->user()->isAdmin()) {
                return 'admin.dashboard';
            } else {
                return 'frontend.index';
            }
        }

        return 'frontend.index';
    }
}

if (!function_exists('style')) {

    /**
     * @param       $url
     * @param array $attributes
     * @param null $secure
     *
     * @return mixed
     */
    function style($url, $attributes = [], $secure = null)
    {
        return resolve(HtmlHelper::class)->style($url, $attributes, $secure);
    }
}


if (!function_exists('get_test_file')) {

    /**
     * @param       $url
     * @param array $attributes
     * @param null $secure
     *
     * @return mixed
     */
    function get_test_file($user_id, $question_id)
    {
        $test_result =  App\Models\Media::where('model_type', 'App\Models\Result')
            ->where('model_id', $user_id)
            ->where('file_name', $question_id)
            ->first();
        if (@$test_result->id)
            return "<a target='_blank' href='" . $test_result->url . "'>" . __('labels.frontend.course.download') . "</a>";
    }
}

if (!function_exists('script')) {

    /**
     * @param       $url
     * @param array $attributes
     * @param null $secure
     *
     * @return mixed
     */
    function script($url, $attributes = [], $secure = null)
    {
        return resolve(HtmlHelper::class)->script($url, $attributes, $secure);
    }
}

if (!function_exists('form_cancel')) {

    /**
     * @param        $cancel_to
     * @param        $title
     * @param string $classes
     *
     * @return mixed
     */
    function form_cancel($cancel_to, $title, $classes = 'btn btn-danger ')
    {
        return resolve(HtmlHelper::class)->formCancel($cancel_to, $title, $classes);
    }
}

if (!function_exists('form_submit')) {

    /**
     * @param        $title
     * @param string $classes
     *
     * @return mixed
     */
    function form_submit($title, $classes = 'btn btn-success pull-right')
    {
        return resolve(HtmlHelper::class)->formSubmit($title, $classes);
    }
}

if (!function_exists('camelcase_to_word')) {

    /**
     * @param $str
     *
     * @return string
     */
    function camelcase_to_word($str)
    {
        return implode(' ', preg_split('/
          (?<=[a-z])
          (?=[A-Z])
        | (?<=[A-Z])
          (?=[A-Z][a-z])
        /x', $str));
    }
}



if (!function_exists('test_res')) {
    function test_res($result_id, $question_id)
    {
        return  $test_result =  App\Models\ResultsAnswer::where('result_id', $result_id)
            ->where('question_id', $question_id)
            ->first();
    }
}


if (!function_exists('rate_average')) {
    function rate_average($user_id, $course_id)
    {
        $rate_average =  DB::table('user_course_rates')->select(DB::raw('AVG(user_rate_answers.answer) as average_rating'))->where('course_id', $course_id)->where('user_id', $user_id)->where('user_rate_answers.answer', 'regexp', '^[0-9]+')->join('user_rate_answers', 'user_rate_answers.user_course_rate_id', '=', 'user_course_rates.id')
            ->first();

        return $rate_average->average_rating;
    }
}


if (!function_exists('option_txt')) {
    function option_txt($option_id)
    {
        return  $test_result =  App\Models\QuestionsOption::where('id', $option_id)->first();
    }
}



if (!function_exists('contact_data')) {

    /**
     * @param $str
     *
     * @return array
     */
    function contact_data($str)
    {
        $newElements = [];
        $elements = json_decode($str);
        foreach ($elements as $key => $item) {
            $newElements[$item->name] = ['value' => $item->value, 'status' => $item->status];
        }
        return $newElements;
    }
}

if (!function_exists('section_filter')) {

    /**
     * @param $str
     * Filter according to type selected.
     * 1 = Popular Categories
     * 2 = Featured Course
     * 3 = Trending Courses
     * 4 = Popular Courses
     * 5 = Custom Links
     * @return array
     */
    function section_filter($section)
    {
        $type = $section->type;
        $section_data = "";
        $section_title = "";
        $content = [];

        if ($type == 1) {
            $section_content = \App\Models\Category::has('courses', '>', 7)
                ->where('status', '=', 1)->get()->take(6);
            $section_title = trans('labels.frontend.footer.popular_categories');
            foreach ($section_content as $item) {
                $single_item = [
                    'label' => $item->name,
                    'link' => route('courses.category', ['category' => $item->slug])
                ];
                $content[] = $single_item;
            }
        } else if ($type == 2) {
            $section_content = \App\Models\Course::where('featured', '=', 1)
                ->has('category')
                ->where('published', '=', 1)
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();
            $section_title = trans('labels.frontend.footer.featured_courses');
            foreach ($section_content as $item) {
                $single_item = [
                    'label' => $item->title,
                    'link' => route('courses.show', [$item->slug])
                ];
                $content[] = $single_item;
            }
        } else if ($type == 3) {
            $section_content = \App\Models\Course::where('trending', '=', 1)
                ->has('category')
                ->where('published', '=', 1)
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();
            $section_title = trans('labels.frontend.footer.trending_courses');
            foreach ($section_content as $item) {
                $single_item = [
                    'label' => $item->title,
                    'link' => route('courses.show', [$item->slug])
                ];
                $content[] = $single_item;
            }
        } else if ($type == 4) {
            $section_content = \App\Models\Course::where('popular', '=', 1)
                ->has('category')
                ->where('published', '=', 1)
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();
            $section_title = trans('labels.frontend.footer.popular_courses');
            foreach ($section_content as $item) {
                $single_item = [
                    'label' => $item->title,
                    'link' => route('courses.show', [$item->slug])
                ];
                $content[] = $single_item;
            }
        } else if ($type == 5) {
            $section_title = trans('labels.frontend.footer.useful_links');
            $section_content = $section->links;
            foreach ($section_content as $item) {
                $single_item = [
                    'label' => $item->label,
                    'link' => $item->link
                ];
                $content[] = $single_item;
            }
        }

        return ['section_content' => $content, 'section_title' => $section_title];
    }
}

if (!function_exists('FromTOCurrency')) {
    function FromTOCurrency($from, $to)
    {
        # code...
        $url = "https://freecurrencyapi.net/api/v2/latest?apikey=d59527d0-8a82-11ec-aa36-695b4fea46e6&base_currency=" . $from;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        try {
            //code...
            $dollar = json_decode($response)->data->$to;
        } catch (\Throwable $th) {
            //throw $th;
            // if($from=='USD' && $to=='SAR')
            $dollar = 3.75;
        }

        return $dollar;
    }
}
if (!function_exists('ConvertTOCurrency')) {
    function ConvertTOCurrency($amount, $from = "USD", $to = 'SAR')
    {
        # code...
        return floatval(number_format($amount * FromTOCurrency($from, $to), 2));
    }
}
if (!function_exists('SendSMS')) {
    function SendSMS($data = false, $method = 'GET', $url = 'https://alghaddm.com/sms/api.php')
    {
        $username = '966550011532';
        $key = '4pnzc9vp2u01';
        $sender = 'Ptc';
        $data['username'] = $username;
        $data['key'] = $key;
        $data['sender'] = $sender;
        // dd(sprintf("%s?%s", $url, http_build_query($data)));
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // // Optional Authentication:
        // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        // curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }
}
if (!function_exists('generateInvoice')) {

    function generateInvoice($order)
    {


        $invoice = new \App\Http\Controllers\Traits\InvoiceGenerator();
        $invoice->number($order->id);

        foreach ($order->items as $item) {

            if ($item->item_type == 'App\Models\Course') {
                $title = $item->item->title;
                // $price = $item->item->price;
                $group = \App\Models\CourseGroup::find($item->item_group_id);
                $courseLocation = $group->title_en;
                $currency = $group->currency == 'SAR' ? 'SAR' : '$';
                Session::put('currency', $currency);
                $price = $item->price;
                $qty = 1;
                $id = 'prod-' . $item->item->id;
                $img = $group->courses->course_image;
                $qrContent = asset('storage/invoices/' . 'invoice-' . $order->id . '.pdf');
                Storage::disk('Qr')->put("qrCodes/" . 'invoice-' . $order->id . '.svg', DNS2D::getBarcodeSVG($qrContent, 'QRCODE'));
                $invoice->addItem($title . ' (' . $courseLocation . ')', $price, $qty, $id, $img);
            } else {

                $title = $item->item->title;
                $price = $item->item->price;
                // $price = $item->price;
                $currency = 'SAR';
                Session::put('currency', $currency);
                $courseLocation = '';
                $qty = 1;
                $id = 'prod-' . $item->item->id;
                $invoice->addItem($title . ' (' . $courseLocation . ')', $price, $qty, $id, $currency);
            }
        }

        $total = $order->items->sum('price');

        $taxes = \App\Models\Tax::where('status', '=', 1)->get();
        $rateSum = \App\Models\Tax::where('status', '=', 1)->sum('rate');
        if ($taxes != null) {
            $taxData = [];
            foreach ($taxes as $tax) {

                $taxData[] = [
                    'name' => $tax->name,
                    'amount' => $total * ($tax->rate / 100),
                    'tax' => $tax->rate,
                    'tax_type' => 'percentage'
                    ];
            }
            $invoice->addTaxData($taxData);
            $total =  $total + ($total * $rateSum / 100);
        }

        $coupon = \App\Models\Coupon::find($order->coupon_id);
        if ($coupon != null) {
            $discount = 0;
            //if coupon type is fixed amount then calculate discount
            if ($coupon->type == 2) {
                $discount = $coupon->amount;
            }
            //if coupon type is percentage then calculate discount
            elseif ($coupon->type == 1) {
                $discount = $total * ($coupon->amount / 100);
            }

            $invoice->addDiscountData($discount);
            $total = $total - $discount;
        }

        $invoice->addTotal($total);

        $user = \App\Models\Auth\User::find($order->user_id);

        
        $invoice->customer([
            'name' => $user->full_name,
            'id' => $user->id,
            'email' => $user->email,
            'country' => $user->country,
            'city' => $user->city,
            'phone' => $user->phone,
        ]);


        $name = 'invoices/invoice-' . $order->id . '.pdf';
        $invoicePdf = new \App\Http\Controllers\Traits\InvoicePDFGenerator();

        $invoice = $invoicePdf->generate($invoice, 'invoice_new');
        Storage::put($name, $invoice->output());



        $invoiceEntry = \App\Models\Invoice::where('order_id', '=', $order->id)->first();

        if ($invoiceEntry == "") {
            $invoiceEntry = new \App\Models\Invoice();
            $invoiceEntry->user_id = $order->user_id;
            $invoiceEntry->order_id = $order->id;
            $invoiceEntry->url = 'invoice-' . $order->id . '.pdf';
            $invoiceEntry->save();
        }
    }
}

if (!function_exists('trashUrl')) {

    /**
     * @param $str
     *
     * @return array
     */
    function trashUrl($request)
    {
        $currentQueries = $request->query();

        //Declare new queries you want to append to string:
        $newQueries = ['show_deleted' => 1];

        //Merge together current and new query strings:
        $allQueries = array_merge($currentQueries, $newQueries);

        //Generate the URL with all the queries:
        return $request->fullUrlWithQuery($allQueries);
    }
}

if (!function_exists('getCurrency')) {

    /**
     * @param $str
     *
     * @return array
     */
    function getCurrency($short_code)
    {
        $currencies = config('currencies');
        $currency = "";
        foreach ($currencies as $key => $val) {
            if ($val['short_code'] == $short_code) {
                $currency = $val;
            }
        }
        return $currency;
    }
}

if (!function_exists('sub')) {

    function sub($string, $begin = 0, $limit = 100)
    {

        $string = strip_tags($string);

        $string = preg_replace('/\s+/', ' ', $string);
        $string = str_replace("&nbsp;", '', $string);
        $string = str_replace("&ndash;", '', $string);

        $string = mb_substr($string, $begin, $limit, "utf-8");

        return $string;
    }
}

if (!function_exists('resize')) {

    function resize($file_path, $width, $height)
    {

        try {
            $img = Image::make(Storage::path($file_path));

            $img->resize($width, $height);

            $img->save(Storage::path('uploads/thumb/' . $file_path));

            return url('storage/uploads/thumb/' . $file_path);
        } catch (Throwable $e) {
            // dd(Storage::path($file_path));

            return false;
        }
    }
}


if (!function_exists('menuList')) {


    function menuList($array)
    {
        $temp_array = array();
        foreach ($array as $item) {
            if ($item->getsons($item->id)->except($item->id)) {
                $item->subs = menuList($item->getsons($item->id)->except($item->id)); // here is the recursion
                $temp_array[] = $item;
            }
        }
        return $temp_array;
    }
}
