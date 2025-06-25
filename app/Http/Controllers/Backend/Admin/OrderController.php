<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Helpers\General\EarningHelper;
use App\Models\Auth\User;
use App\Models\Bundle;
use App\Models\Course;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Response;


class OrderController extends Controller
{

    /**
     * Display a listing of Orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::get();
        //payment status 0 = pending, 1 = completed, 2 = failed
        $payment_status = [
            0 => 'pending',
            1 => 'completed',
            2 => 'failed'
        ];
        return view('backend.orders.index', compact('orders', 'payment_status'));
    }

    /**
     * Display a listing of Orders via ajax DataTable.
     *
     * @return \Illuminate\Http\Response
     */
    // public function getData(Request $request)
    // {
    //     if (request('offline_requests') == 1) {

    //         $orders = Order::where('payment_type', '=', 3)->orderBy('updated_at', 'desc')->get();
    //     } else {
    //         $orders = Order::orderBy('updated_at', 'desc')->get();
    //     }

    //     return DataTables::of($orders)
    //         ->addIndexColumn()
    //         ->addColumn('actions', function ($q) use ($request) {
    //             $view = "";

    //             $view = view('backend.datatable.action-view')
    //                 ->with(['route' => route('admin.orders.show', ['order' => $q->id])])->render();

    //             if ($q->status == 0) {
    //                 $complete_order = view('backend.datatable.action-complete-order')
    //                     ->with(['route' => route('admin.orders.complete', ['order' => $q->id])])
    //                     ->render();
    //                 $view .= $complete_order;
    //             }

    //             if ($q->status == 0) {
    //                 $delete = view('backend.datatable.action-delete')
    //                 ->with(['route' => route('admin.orders.destroy', ['order' => $q->id])])
    //                 ->render();

    //                 $view .= $delete;
    //             }
    //             if($q->bank_transfer_receipt){
                    
    //                 $popupImageReceipt = view('backend.datatable.action-order-popupReceipt')
    //                 ->with(['order' => $q])
    //                 ->render();
    //                 $view .= $popupImageReceipt;


    //             }

    //             return $view;

    //         })
    //         ->addColumn('items', function ($q) {
    //             $items = "";
    //             foreach ($q->items as $key => $item) {
    //                 if($item->item != null){
    //                     $key++;
    //                     $items .= $key . '. ' . $item->item->title . "<br>";
    //                 }

    //             }
    //             return $items;
    //         })
    //         ->addColumn('user_email', function ($q) {
    //             return $q->user?$q->user->email:'';
    //         })
    //         ->addColumn('user_name', function ($q) {
    //             $name='';
    //             if(session('locale')=='ar')
    //             $name=$q->user?$q->user->name_ar.' '.$q->user->second_name_ar.''.$q->user->third_name_ar.'  '.$q->user->fourth_name_ar:'';
    //             else
    //             $name=$q->user?$q->user->first_name.' '.$q->user->last_name.''.$q->user->third_name.'  '.$q->user->fourth_name:'';
               
    //             return $name;
    //         })
    //         ->addColumn('payment_type', function ($q) {
    //             $paytype='';
    //             if(session('locale')=='ar'){
                   
    //                 if($q->payment_type==3)
    //                 $paytype='مضاف من الادمن';
    //                 if($q->payment_type==4)
    //                 $paytype='تم الدفع عن طريق ماي فاتورة';
    //             }
    //             else{
    //                 if($q->payment_type==3)
    //                 $paytype='By Admin';
    //                 if($q->payment_type==4)
    //                 $paytype='Payed By MyFatoorah';
    //             }
                
    //             return $paytype;
    //         })
    //         ->addColumn('date', function ($q) {
    //             return $q->updated_at->diffforhumans();
    //         })
    //         ->addColumn('payment', function ($q) {
    //             if ($q->status == 0) {
    //                 $payment_status = trans('labels.backend.orders.fields.payment_status.pending');
    //             } elseif ($q->status == 1) {
    //                 $payment_status = trans('labels.backend.orders.fields.payment_status.completed');
    //             } else {
    //                 $payment_status = trans('labels.backend.orders.fields.payment_status.failed');
    //             }
    //             return $payment_status;
    //         })
    //         ->editColumn('price', function ($q) {
    //             return '$' . floatval($q->price);
    //         })
    //         ->rawColumns(['items', 'actions'])
    //         ->make();
    // }
    public function getData(Request $request)
    {
        $length = $request->input('length');
        $start = $request->input('start');
        $page = $start ? ($start / $length) + 1 : 1;

        $query = Order::query()->orderBy('created_at', 'desc');

        if ($request->input('offline_requests') == 1) {
            $query->where('payment_type', '=', 3);
        }

        $orders = $query->with(['items', 'user'])->paginate($length, ['*'], 'page', $page);

        $data = [];
        foreach ($orders as $order) {
            $data[] = [
                'DT_RowIndex' => $order->id,
                'id' => $order->id,
                'reference_no' => $order->reference_no,
                'items' => $order->items->map(function ($item, $index) {
                    return ($index + 1) . '. ' . ($item->item ? $item->item->title : '');
                })->implode('<br>'),
                'amount' => $order->amount,
                'user_email' => $order->user ? $order->user->email : '',
                'user_name' => (app()->getLocale() == 'ar') ? $order->user->full_name_ar : $order->user->full_name,
                'payment_type' => $order->payment_type,
                'payment' => $order->status,
                'date' => $order->updated_at->diffforhumans(),
                'actions' => view('backend.datatable.action-view')
                    ->with(['route' => route('admin.orders.show', ['order' => $order->id])])->render()
            ];
        }

        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $orders->total(),
            'recordsFiltered' => $orders->total(),
            'data' => $data
        ];
        return response()->json($response);
        }

    /**
     * Filter Orders.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function filterData(Request $request){

        $query = Order::query();

        if ($request->has('reference_no')) {
            $query->where('reference_no', 'like', '%' . $request->get('reference_no') . '%');
        }

        if ($request->has('status') && $request->get('status') != '') {
            $query->where('status', $request->get('status'));
        }

        if ($request->has('email') && $request->get('email') != '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->get('email') . '%');
            });
        }

        if ($request->has('name') && $request->get('name') != '') {
            $userId = User::findByName($request->get('name'));
            $query->whereIn('user_id', $userId);
        }

        if ($request->has('date') && $request->get('date') != '') {
            $date = date('Y-m-d', strtotime($request->get('date')));
            $query->whereDate('created_at', $date);
        }

        $orders = $query->get();

        $data = [];
        foreach ($orders as $order) {
            $data[] = [
                'id' => $order->id,
                'DT_RowIndex' => $order->id,
                'reference_no' => $order->reference_no,
                'items' => $order->items->map(function ($item, $index) {
                    return ($index + 1) . '. ' . ($item->item ? $item->item->title : '');
                })->implode('<br>'),
                'amount' => $order->amount,
                'user_email' => $order->user ? $order->user->email : '',
                'user_name' => $order->user ? $order->user->name : '',
                'payment_type' => $order->payment_type,
                'payment' => $order->status,
                'date' => $order->updated_at->diffforhumans(),
                'actions' => view('backend.datatable.action-view')
                    ->with(['route' => route('admin.orders.show', ['order' => $order->id])])->render()
            ];
        }

        $response = [
            'draw' => $request->input('draw'),
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
                $orderItem->group->students()->attach($order->user_id);
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
    public function show($id)
    {
        $order = Order::findOrFail($id);
        generateInvoice($order);

        return view('backend.orders.show', compact('order'));
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
