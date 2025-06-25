<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Helpers\General\EarningHelper;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Bundle;
use App\Models\CartItem;
use App\Models\Course;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class CheckoutController extends Controller
{

    /**
     * Display a listing of Orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = CartItem::all();
        $orders = Order::all();
        //payment status 0 = pending, 1 = completed, 2 = failed
        $payment_status = [
            0 => 'pending',
            1 => 'completed',
            2 => 'failed'
        ];
        return view('backend.orders.checkout.index', compact('items','orders', 'payment_status'));
    }


    public function getData(Request $request)
    {
        $length = $request->input('length');
        $start = $request->input('start');
        $page = $start ? ($start / $length) + 1 : 1;

        $query = CartItem::select('user_id', \DB::raw('COUNT(*) as item_count'), \DB::raw('MAX(created_at) as latest_created_at'))
            ->groupBy('user_id')
            ->with('user') // Assuming there's a 'user' relationship defined in CartItem model
            ->orderBy('latest_created_at', 'desc');
        $items = $query->with(['course', 'group', 'user'])->paginate($length, ['*'], 'page', $page);
//        $items = $query->paginate($length, ['*'], 'page', $page);

        $data = [];
        $index = 1;
        foreach ($items as $item) {
            $data[] = [
                'DT_RowIndex' => $index++,
                'user_id' => $item->user_id,
                'user_name' => (app()->getLocale() == 'ar') ? $item->user->full_name_ar : $item->user->full_name,
                'user_email' => $item->user->email,
                'user_phone' => $item->user->phone,
                'item_count' => $item->item_count,
                'actions' => view('backend.datatable.action-view')
                    ->with(['route' => route('admin.checkout.show', ['user_id' => $item->user_id])])->render()
            ];
        }

        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $items->total(),
            'recordsFiltered' => $items->total(),
            'data' => $data
        ];
        return response()->json($response);
        }

    /**
     * Complete Order manually once payment received.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function complete(Request $request)
    {

        
        $order = Order::findOrfail($request->order);
        
        $order->status = 1;
        $order->save();

        (new EarningHelper)->insert($order);

        
        //Generating Invoice
        generateInvoice($order);
        
        foreach ($order->items as $orderItem) {
            //Bundle Entries
            if($orderItem->item_type == Bundle::class){
               foreach ($orderItem->item->courses as $course){
                //    $course->students()->attach($order->user_id);
                   $first_location_id=$course->locations->first()?$course->locations->first()->pivot->id:0;
                   $course->students()->attach($order->user_id,['course_location_id'=>$first_location_id]);
               }
            $orderItem->item->students()->attach($order->user_id);

            }
            else{
            $orderItem->item->students()->attach($order->user_id,['course_location_id'=>$orderItem->item_location_id]);
            }
        }
        // dd($request);
        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    /**
     * Show Order from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        $items = CartItem::where('user_id', $user_id)->get();
        $orders = Order::where('user_id', $user_id)->with('items')->get();

        $courseItems = collect();
        foreach ($items as $item) {
            foreach ($orders as $order) {
                foreach ($order->items as $orderItem) {
                    if ($orderItem->item_id == $item->course_id && $orderItem->item_type == Course::class) {
                        $courseItems->push($item);
                        break 2; //Found a match, no need to check further
                    }
                }
            }
        }

        return view('backend.orders.checkout.show', compact('user','orders', 'items', 'courseItems'));
    }

    /**
     * Remove Order from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $order = Order::findOrFail($id);
        $order->items()->delete();
        $order->delete();
        return redirect()->route('admin.orders.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Orders at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('course_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Order::whereIn('id', $request->input('ids'))->get();
            foreach ($entries as $entry) {
                if ($entry->status = 1) {
                    foreach ($entry->items as $item) {
                        $item->course->students()->detach($entry->user_id);
                    }
                    $entry->items()->delete();
                    $entry->delete();
                }
            }
        }
    }


}
