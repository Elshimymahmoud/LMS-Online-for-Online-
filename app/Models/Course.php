<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Form;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

/**
 * Class Course
 *
 * @package App
 * @property string $title
 * @property string $slug
 * @property text $description
 * @property decimal $price
 * @property string $course_image
 * @property string $start_date
 * @property tinyInteger $published
 */
class Course extends Model
{
    use SoftDeletes;

    protected $fillable = ['category_id', 'type_id', 'level_id','course_classification_id','CoursClint_id','place', 'location_id', 'title', 'title_ar', 'slug', 'description', 'description_ar', 'course_image','course_video', 'published', 'free','featured', 'trending', 'popular', 'meta_title', 'meta_description', 'meta_keywords','accreditation_number','short_description','short_description_ar','timeline','timeline_ar','pdf_title','pdf_title_ar','short_desc_in_certificate','pixel_code'];

    protected $appends = ['image'];
 
    protected static function boot()
    {
        parent::boot();
        if (auth()->check()) {
            if (auth()->user()->hasRole('teacher')) {
                static::addGlobalScope('filter', function (Builder $builder) {
                    $builder->whereHas('teachers', function ($q) {
                        $q->where('course_user.user_id', '=', auth()->user()->id);
                    });
                });
            }
        }

        static::deleting(function ($course) { // before delete() method call this
            if ($course->isForceDeleting()) {
                if (File::exists(public_path('/storage/uploads/' . $course->course_image))) {
                    File::delete(public_path('/storage/uploads/' . $course->course_image));
                    File::delete(public_path('/storage/uploads/thumb/' . $course->course_image));
                }
            }
        });


    }


    public function classification()
    {
        return $this->belongsTo(CourseClassification::class, 'course_classification_id');
    }

    public function getImageAttribute()
    {
        if ($this->course_image != null) {
            return url('storage/uploads/'.$this->course_image);
        }
        return NULL;
    }

    // public function getPriceAttribute()
    // {
    //     if (($this->attributes['price'] == null)) {
    //         return round(0.00);
    //     }
    //     return $this->attributes['price'];
    // }


    /**
     * Set attribute to money format
     * @param $input
     */
    // public function setPriceAttribute($input)
    // {
    //     $this->attributes['price'] = $input ? $input : null;
    // }

    /**
     * Set attribute to date format
     * @param $input
     */
    // public function setStartDateAttribute($input)
    // {
    //     if ($input != null && $input != '') {
    //         $this->attributes['start_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
    //     } else {
    //         $this->attributes['start_date'] = null;
    //     }
    // }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    // public function getStartDateAttribute($input)
    // {
    //     $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

    //     if ($input != $zeroDate && $input != null) {
    //         return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
    //     } else {
    //         return '';
    //     }
    // }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'course_user')->withPivot('user_id','course_location_id');
    }
 
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student','course_id','user_id')->withTimestamps()->withPivot(['rating','course_location_id','created_at']);
    }
    public function studentsCourseLocation($courseLocationId)
    {
        return $this->belongsToMany(User::class, 'course_student')->where('course_location_id',$courseLocationId)->withTimestamps()->withPivot(['rating']);
    }
    public function studentCourseLocationById($userId)
    {
        
        return $this->belongsToMany(User::class, 'course_student')->where('user_id',$userId)->withTimestamps()->withPivot(['rating','course_location_id']);
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('position');
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class)->orderBy('chapters.position');
    }

    public function publishedLessons()
    {
        return $this->hasMany(Lesson::class)->where('published', 1);
    }

    // public function rates()
    // {
    //     return $this->belongsToMany(Rate::class, 'course_rates');
    // }
    // public function rates()
    // {
    //     return $this->belongsToMany(Forms::class, 'course_forms');
    // }
    public function forms()
    {
        return $this->belongsToMany(Forms::class, 'course_forms');
    }
    public function impactMeasurments()
    {
        return $this->belongsToMany(Forms::class, 'course_forms')->where('forms.form_type','impact_measurments');
    }

    public function impactMeasurment()
    {
        return $this->belongsToMany(Forms::class, 'course_forms')->where('form_type','impact_measurments')->get();
    }
   
    public function programRecommendations()
    {
        return $this->belongsToMany(Forms::class, 'course_forms')->where('form_type','program_recommendation');
    }
    
    public function scopeOfTeacher($query)
    {
        if (!Auth::user()->isAdmin()) {
            return $query->whereHas('teachers', function ($q) {
                $q->where('user_id', Auth::user()->id);
            });
        }
        // dd($query);
        return $query;
    }

    public function getRatingAttribute()
    {
        return $this->reviews->avg('rating');
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //course_types
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function locations()
    {
        return $this->belongsToMany(Location::class,'course_locations')->withPivot('price','start_date','end_date','id','currency');;
    }
    public function minPricelocation()
    {
        // Get the first group
        $group = $this->groups()->first();

        if (!$group) {
            return 0;
        }

        return $group->price;
    }
    public function minPricelocationCurr()
    {
        // Get the first group
        $group = $this->groups()->first();

        if (!$group) {
            return "SAR";
        }


        return $group->currency;
    }
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    // public function tests()
    // {
    //     return $this->hasMany('App\Models\Forms');
    // }
    public function tests()
    {
        
        return $this->belongsToMany(Forms::class,'course_forms')->withPivot('forms_id','course_id','id');

    }
    public function courseTimeline()
    {
        return $this->hasMany(CourseTimeline::class)->orderBy('sequence');
    }

    public function chapter()
    {
        return $this->hasMany(Chapters::class)->orderBy('chapters.position');
    }

    public function getIsAddedToCart(){
        if(auth()->check() && (auth()->user()->hasRole('student')) && (\Cart::session(auth()->user()->id)->get( $this->id))){
            return true;
        }
        return false;
    }


    public function reviews()
    {
        return $this->morphMany('App\Models\Review', 'reviewable');
    }


    public function progress($userCourseGroup)
    {
        $completed_test_count = 0;

        // Get the course group ID from the request
//        $userCourseGroup = request('group') ?? request('course_group_id') ?? request('course_group') ?? request('group_id') ?? null;
        // If the course group ID is not provided in the request
        if (!$userCourseGroup) {
            // Get the course group associated with the authenticated user
            // TODO: make this function to get student groups
            $studentCourseGroup = $this->studentCourseGroupById(auth()->user()->id)->first();

            // If the user has a course group, use its ID
            if ($studentCourseGroup) {
                $userCourseGroup = $studentCourseGroup->pivot->course_group_id;
            } else {
                $userCourseGroup = null;
            }
        }

        $completed_lessons = auth()->user()->chapters()->where('course_id', $this->id)->where('course_group_id',
            $userCourseGroup)->get();


        // Fetch all lessons associated with the group
        $lessons = $this->lessons()->pluck('id');
        $group = CourseGroup::find($userCourseGroup);
        $groupTests = $group->tests()->get();
        $main_chapter_timeline = $lessons->concat($groupTests);

//        foreach ($groupTests as $test) {
//            $main_chapter_timeline->push($test->id);
//        }

        // Initialize the total score of the user and the total score of all tests
        $userTestResult = 0;
        $AllScore = 0;

        // For each test
        foreach ($groupTests as $test) {
            // Add the total score of the test to the total score of all tests
            $AllScore += $test->questions()->sum('score');

            // Get the result of the test for the user
            $testResult = $test->results()->where('user_id', auth()->user()->id)->get();
            // If the user has a result for the test
            if (count($testResult) > 0) {
                // Add the result of the test to the total score of the user
                $userTestResult += $testResult[0]->test_result;
            }

            // If the total score of all tests is not zero and the ratio of the total score of the user to the total score of all tests is greater than 0.5
            if ($AllScore != 0 && $userTestResult / $AllScore > 0.5) {
                // Increment the count of completed tests
                $completed_test_count++;
            }
        }

        // If there are completed lessons
        if (count($completed_lessons) > 0) {
            // If there are no lessons or tests in the course that are associated with the course group, return 0
            if (count($main_chapter_timeline) <= 0) {
                return 0;
            }

            // Calculate the progress as the ratio of the count of completed lessons to the count of lessons and tests in the course that are associated with the course group, multiplied by 100
            $progress = round((count($completed_lessons) + $completed_test_count) / count($main_chapter_timeline) * 100);
            // Return the progress, but not more than 100
            return min($progress, 100);
        } else {
            // If there are no completed lessons, return 0
            return 0;
        }
    }

    public function getStudentProgress($studentId, $userCourseGroup)
    {
        // Find the student
        $student = User::find($studentId);

        // If the student is not found, return null
        if (!$student) {
            return 0;
        }
        $completed_test_count = 0;

        // Get the course group ID from the request
//        $userCourseGroup = request('group') ?? request('course_group_id') ?? request('course_group') ?? request('group_id') ?? null;
        // If the course group ID is not provided in the request
        if (!$userCourseGroup) {
            // Get the course group associated with the authenticated user
            // TODO: make this function to get student groups
            $studentCourseGroup = $this->studentCourseGroupById($student->id)->first();

            // If the user has a course group, use its ID
            if ($studentCourseGroup) {
                $userCourseGroup = $studentCourseGroup->pivot->course_group_id;
            } else {
                $userCourseGroup = null;
            }
        }

        $completed_lessons = $student->chapters()->where('course_id', $this->id)->where('course_group_id',
            $userCourseGroup)->get();


        // Fetch all lessons associated with the group
        $lessons = $this->lessons()->pluck('id');
        $group = CourseGroup::find($userCourseGroup);
        $groupTests = $group->tests()->get();
        $main_chapter_timeline = $lessons->concat($groupTests);

//        foreach ($groupTests as $test) {
//            $main_chapter_timeline->push($test->id);
//        }

        // Initialize the total score of the user and the total score of all tests
        $userTestResult = 0;
        $AllScore = 0;

        // For each test
        foreach ($groupTests as $test) {
            // Add the total score of the test to the total score of all tests
            $AllScore += $test->questions()->sum('score');

            // Get the result of the test for the user
            $testResult = $test->results()->where('user_id', $student->id)->get();
            // If the user has a result for the test
            if (count($testResult) > 0) {
                // Add the result of the test to the total score of the user
                $userTestResult += $testResult[0]->test_result;
            }

            // If the total score of all tests is not zero and the ratio of the total score of the user to the total score of all tests is greater than 0.5
            if ($AllScore != 0 && $userTestResult / $AllScore > 0.5) {
                // Increment the count of completed tests
                $completed_test_count++;
            }
        }

        // If there are completed lessons
        if (count($completed_lessons) > 0) {
            // If there are no lessons or tests in the course that are associated with the course group, return 0
            if (count($main_chapter_timeline) <= 0) {
                return 0;
            }

            // Calculate the progress as the ratio of the count of completed lessons to the count of lessons and tests in the course that are associated with the course group, multiplied by 100
            $progress = round((count($completed_lessons) + $completed_test_count) / count($main_chapter_timeline) * 100);
            // Return the progress, but not more than 100
            return min($progress, 100);
        } else {
            // If there are no completed lessons, return 0
            return 0;
        }
    }

    // public function progressOld()
    // {
       
       
    //     $completed_lessons_count=0;
    //     $main_chapter_timeline = $this->lessons()->pluck('id')->merge($this->tests()->where('form_type','test')->pluck('forms.id'));
    //     $completed_lessons = auth()->user()->chapters()->where('course_id', $this->id)->pluck('model_id');
    //     //######/////////////////////////////////////////////////////////////////////////////
    //     //######get user test score##########################################
    //     //###### and all course test score to get percent of student answers######
    //     //   dd($completed_lessons);
    //     $course_tests = $this->tests()->where('course_id', $this->id)->get();
    //     $userTestResult=0;
    //     $AllScore=0;
    //     foreach ($course_tests as $key => $test) {
    //         # code...
           
    //         $AllScore+=$test->questions()->sum('score');
           
    //         $testResult=$test->TestsResult()->where('user_id',auth()->user()->id)->get();
    //         if(count($testResult)>0)
    //         $userTestResult+=$testResult[0]->test_result;

    //         if($AllScore!=0)
    //         if($userTestResult/$AllScore>0.5)
    //         $completed_lessons_count++;
           
            
    //     }
      
        
    //     // /////////////////////////////////////////////////////////////////////////////////////////
    //     if ($completed_lessons->count() > 0) {
    //         if(intval($completed_lessons->count()+$completed_lessons_count / $main_chapter_timeline->count() * 100)<100 )
    //         return intval($completed_lessons->count() / $main_chapter_timeline->count() * 100);
    //         // return 100;
            
            
    //         else
    //         return 100;
    //     } else {
    //         return 0;
    //     }
    // }
    public function isUserCertified()
    {
        $status = false;
        $certified = auth()->user()->certificates()->where('course_id', '=', $this->id)->first();
        if ($certified != null) {
            $status = true;
        }
        return $status;
    }

    public function item()
    {
        return $this->morphMany(OrderItem::class, 'item');
    }

    public function bundles()
    {
        return $this->belongsToMany(Bundle::class, 'bundle_courses');
    }

    public function chapterCount()
    {
        $timeline = $this->courseTimeline;
        $chapters = 0;
        foreach ($timeline as $item) {
            if (isset($item->model) && ($item->model->published == 1)) {
                $chapters++;
            }
        }
        return $chapters;
    }

    public function mediaVideo()
    {
        $types = ['youtube', 'vimeo', 'upload', 'embed','zoom'];
        return $this->morphOne(Media::class, 'model')
            ->whereIn('type', $types);

    }
    public function mediaPdf()
    {
        $types = ['course_pdf'];
        return $this->morphOne(Media::class, 'model')
            ->whereIn('type', $types);

    }
public  function courseDuration()
{
    # code...
    $hours=$this->chapters->where('length_type','hour')->sum('session_length');
  
    $minutes=$this->chapters->where('length_type','minute')->sum('session_length');
    if($minutes%60==0)
    $hours+=$minutes/60;
    else{
        $hours+=intval($minutes/60);
    $minutes=fmod($minutes,60);

    }
    return ['hours'=>$hours,'minutes'=>$minutes];

}
    public function courseDurationFromFirstGroup()
    {
        // Get the first group
        $group = $this->groups()->first();

        if (!$group) {
            return ['hours' => 0, 'minutes' => 0];
        }

        // Get the course lessons of the group
        $lessons = $group->courseLessons;

        $totalDurationInMinutes = 0;

        foreach ($lessons as $lesson) {
            // Calculate the duration of each lesson in minutes
            $startTime = Carbon::parse($lesson->pivot->start_time);
            $endTime = Carbon::parse($lesson->pivot->end_time);
            $duration = $endTime->diffInMinutes($startTime);
            // Add the duration to the total duration
            $totalDurationInMinutes += $duration;
        }

        // Convert the total duration to hours and minutes
        $hours = floor($totalDurationInMinutes / 60);
        $minutes = $totalDurationInMinutes % 60;

        return ['hours' => $hours, 'minutes' => $minutes];
    }
    public function courseGroupDuration($group_id)
    {
        // Get the group
        $group = CourseGroup::findOrFail($group_id);

        if (!$group) {
            return ['hours' => 0, 'minutes' => 0];
        }

        // Get the course lessons of the group
        $lessons = $group->first()->courseLessons;

        $totalDurationInMinutes = 0;

        foreach ($lessons as $lesson) {
            // Calculate the duration of each lesson in minutes
            $startTime = Carbon::parse($lesson->pivot->start_time);
            $endTime = Carbon::parse($lesson->pivot->end_time);
            $duration = $endTime->diffInMinutes($startTime);
            // Add the duration to the total duration
            $totalDurationInMinutes += $duration;
        }

        // Convert the total duration to hours and minutes
        $hours = floor($totalDurationInMinutes / 60);
        $minutes = $totalDurationInMinutes % 60;

        return ['hours' => $hours, 'minutes' => $minutes];
    }

//
//public  function courseDurationByCourseLocationId($course_location_id)
//{
//    # code...
//    $locationLessonsChapterIds=Lesson::where('course_id',$this->id)->
//        whereHas('courseLocations',function($qq)use($course_location_id){
//            $qq->where('lesson_course_location.course_location_id',$course_location_id);
//        })->get()->pluck('chapter_id')->toArray();
//
//    $hours=$this->chapters()->whereIn('id',$locationLessonsChapterIds)->where('length_type','hour')->sum('session_length');
////    dd(array_unique($locationLessonsChapterIds));
//    $minutes=$this->chapters()->whereIn('id',$locationLessonsChapterIds)->where('length_type','minute')->sum('session_length');
//    if($minutes%60==0)
//    $hours+=$minutes/60;
//    else{
//        $hours+=intval($minutes/60);
//    $minutes=fmod($minutes,60);
//
//    }
//    return ['hours'=>$hours,'minutes'=>$minutes];
//
//}
public function guests()
{
    return $this->belongsToMany(Guest::class,'course_guests','course_id','guest_id');
}
public function LessonsByChapter($chapter_id,$last)
{
    // $timeLine=$this->courseTimeline()
    // ->where('model_type', Lesson::class)
    // ->get();
    $lessonOfFirstLocation=[];
    $alllessonOfFirstLocation=[];
    $countofLess=0;
    $alllessonOfFirstLocation=Lesson::where('chapter_id',$chapter_id)->with('courseLocations')->whereHas('courseLocations', function ($qq) use ($last) {
        $qq->where('lesson_course_location.course_location_id', $last->id)->where('lesson_course_location.model_type', 'App\Models\Lesson');
    })->orderBy('position')->pluck('title_ar');
    // if($chapter_id){
    //     $lessonOfFirstLocation=$alllessonOfFirstLocation
    //     ?$alllessonOfFirstLocation->where('chapter_id',$chapter_id)  
    //     :[];
    // }
    
  

   return [$lessonOfFirstLocation,$alllessonOfFirstLocation];
}
public function AllLessonsByLocation($last)
{
    $alllessonOfFirstLocation=0;
    $id=0;
    
   if($last && get_class($last)=='App\Models\Location'){
    $id=$last->pivot->id;
   }
    else{
        $id=$last->id;
    }
   
    if($id)
    $alllessonOfFirstLocation=Lesson::with('courseLocations')->whereHas('courseLocations', function ($qq) use ($id) {
        $qq->where('lesson_course_location.course_location_id', $id)->where('lesson_course_location.model_type', 'App\Models\Lesson');
    })->count();
   
   return ($alllessonOfFirstLocation);
}
public function AllLessonsByGroup($group_id)
{
    $alllessonOfFirstLocation=0;
    $id=0;

   if($group_id)
    $alllessonOfFirstLocation=Lesson::with('courseGroups')->whereHas('courseGroups', function ($qq) use ($group_id) {
        $qq->where('lesson_course_group.course_group_id', $group_id)->where('lesson_course_group.model_type', 'App\Models\Lesson');
    })->count();

   return ($alllessonOfFirstLocation);
}
public function TestsByChapter($chapter_id,$last)
{
    $timeLine=$this->courseTimeline()
    ->where('model_type', Form::class)
    ->get();
    $testsOfFirstLocation=[];
    foreach ($timeLine as $key => $item) {
        # code...
        if($item->model->chapter_id==$chapter_id){
            $testsOfFirstLocation= $item->model
            ? $item->model
                ->whereHas('courseLocations', function ($qq) use ($last) {
                    $qq->where('lesson_course_location.course_location_id', $last->id)->where('lesson_course_location.model_type', 'App\Models\Lesson');
                })
                ->where('chapter_id',$chapter_id)
                ->get()
               
            : [];
        }
        
       
       
    }
return $testsOfFirstLocation;
   
}
public function groups()
{
    return $this->hasMany(CourseGroup::class);
}

    public function getStudentGroup($studentId)
    {
        $groups = $this->groups;

        foreach ($groups as $group) {
            $students = $group->students;
            foreach ($students as $student) {
                if ($student->id == $studentId) {
                    return $group;
                }
            }
        }

        return null;
    }
    //get all students in all groups
    public function getStudents()
    {
        $groups = $this->groups;
        // If there is no group, return an empty array
        if (count($groups) == 0) {
            return [];
        }

        $students = [];
        foreach ($groups as $group) {
            $students = $group->students;
        }

        return $students;
    }

    public function courseContent()
    {
        return $this->belongsToMany(Content::class, 'course_content');
    }

    public function resources()
    {
        return $this->hasMany(CourseResourceLink::class, 'course_id');
    }
}