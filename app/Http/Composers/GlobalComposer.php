<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Models\Course;
use Carbon\Carbon;


/**
 * Class GlobalComposer.
 */
class GlobalComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $popularCoursesFooter = Course::whereHas('locations',function ($q){
                
            $q->whereDate('end_date', '>=', Carbon::now())->orWhereNull('end_date');
            })
            ->withoutGlobalScope('filter')
        ->whereHas('category')
        ->where('published', '=', 1)
        // ->where('popular', '=', 1)
        ->latest()->take(3)->get();


        // $popularCoursesFooter = Course::withoutGlobalScope('filter')->where('published', '=', 1)
        // ->whereHas('category')
        // ->latest()->take(3)->get();

        // dd($popularCoursesFooter);

        $view->with('logged_in_user', auth()->user());
        $view->with('popularCoursesFooter', $popularCoursesFooter);

    }
}
