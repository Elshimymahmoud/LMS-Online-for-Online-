<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Bundle;
use App\Models\Contact;
use App\Models\Course;
use App\Models\CourseGroup;
use App\Models\CourseLocation;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $purchased_groups = NULL;
        $students_count = NULL;
        $recent_reviews = NULL;
        $threads = NULL;
        $teachers_count = NULL;
        $courses_count = NULL;
        $group_count = NULL;
        $pending_orders = NULL;
        $recent_orders = NULL;
        $recent_contacts = NULL;
        $purchased_bundles = NULL;
        if (\Auth::check()) {

            $purchased_groups = auth()->user()->purchasedGroups();
            $purchased_bundles = auth()->user()->purchasedBundles();
            $pending_orders = auth()->user()->pendingOrders();
            $purchasedOrderItems=auth()->user()->purchasedOrderItems();

            //TODO: configure teacher data from group
            if(auth()->user()->hasRole('teacher')){
                //IF logged in user is teacher
                $students_count = Course::whereHas('teachers', function ($query) {
                    $query->where('user_id', '=', auth()->user()->id);
                })
                    ->withCount('students')
                    ->get()
                    ->sum('students_count');


                $courses_id = auth()->user()->courses()->has('reviews')->pluck('courses.id')->toArray();
                $recent_reviews = Review::where('reviewable_type','=','App\Models\Course')
                    ->whereIn('reviewable_id',$courses_id)
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get();



                $unreadThreads = [];
                $threads = [];
                if(auth()->user()->threads){
                    foreach(auth()->user()->threads as $item){
                        if($item->unreadMessagesCount > 0){
                            $unreadThreads[] = $item;
                        }else{
                            $threads[] = $item;
                        }
                    }
                    $threads = Collection::make(array_merge($unreadThreads,$threads))->take(10) ;

                }

            }elseif(auth()->user()->hasRole('administrator')){
                $students_count = User::role('student')->count();
                $teachers_count = User::role('teacher')->count();
                $courses_count = \App\Models\Course::all()->count() + \App\Models\Bundle::all()->count();
                $group_count = CourseGroup::all()->count();
                $recent_orders = Order::orderBy('created_at','desc')->take(10)->get();
                $recent_contacts = Contact::orderBy('created_at','desc')->take(10)->get();
            }
        }

        return view('backend.dashboard',compact('purchased_groups', 'group_count',  'students_count','threads','recent_reviews','purchased_bundles','teachers_count','courses_count','recent_orders','recent_contacts','pending_orders','purchasedOrderItems'));
    }
}
