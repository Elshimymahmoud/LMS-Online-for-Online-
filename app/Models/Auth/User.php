<?php

namespace App\Models\Auth;

use App\Models\ActivityResult;
use App\Models\Attendence;
use App\Models\Bundle;
use App\Models\Certificate;
use App\Models\ChapterStudent;
use App\Models\Course;
use App\Models\CourseGroup;
use App\Models\Invoice;
use App\Models\Lesson;
use App\Models\Media;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Ticket;
use App\Models\Traits\Uuid;
use App\Models\VideoProgress;
use DB;
use Illuminate\Support\Collection;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Auth\Traits\Method\UserMethod;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Auth\Traits\SendUserPasswordReset;
use App\Models\Auth\Traits\Attribute\UserAttribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Auth\Traits\Relationship\UserRelationship;
use App\Models\CourseLocation;
use App\Models\Earning;
use App\Models\TeacherProfile;
use App\Models\Withdraw;
use Gerardojbaez\Messenger\Contracts\MessageableInterface;
use Gerardojbaez\Messenger\Traits\Messageable;


/**
 * Class User.
 */
class User extends Authenticatable implements MessageableInterface
{
    use HasRoles,
        Notifiable,
        SendUserPasswordReset,
        SoftDeletes,
        UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope,
        Uuid,
        Messageable;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'third_name',
        'fourth_name',
        'email',
        'dob',
        'phone',
        'gender',
        'address',
        'city',
        'pincode',
        'state',
        'country',
        'avatar_type',
        'avatar_location',
        'password',
        'password_changed_at',
        'active',
        'confirmation_code',
        'confirmed',
        'timezone',
        'last_login_at',
        'last_login_ip',
        'national_id_number',
        'name_ar',
        'sec_name_ar',
        'third_name_ar',
        'fourth_name_ar',
        'passport_number',
        'nationality',
        'job'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = ['last_login_at', 'deleted_at'];

    /**
     * The dynamic attributes from mutators that should be returned with the user object.
     * @var array
     */
    protected $appends = ['full_name', 'image'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'confirmed' => 'boolean',
    ];



    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_student');
    }

    public function chapters()
    {
        return $this->hasMany(ChapterStudent::class, 'user_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user');
    }
    public function coursesLocations()
    {
        return $this->belongsToMany(CourseLocation::class, 'course_user', 'user_id', 'course_location_id');
    }
    public function coursesStudent()
    {
        return $this->belongsToMany(Course::class, 'course_student')->withTimestamps()->withPivot(['rating', 'course_location_id']);
    }
    public function bundles()
    {
        return $this->hasMany(Bundle::class);
    }


    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }


    public function getImageAttribute()
    {
        return $this->picture;
    }


    //Calc Watch Time
    public function getWatchTime()
    {
        $watch_time = VideoProgress::where('user_id', '=', $this->id)->sum('progress');
        return $watch_time;
    }

    //Check Participation Percentage
    public function getParticipationPercentage()
    {
        $videos = Media::featured()->where('status', '!=', 0)->get();
        $count = $videos->count();
        $total_percentage = 0;
        if ($count > 0) {
            foreach ($videos as $video) {
                $total_percentage = $total_percentage + $video->getProgressPercentage($this->id);
            }
            $percentage = $total_percentage / $count;
        } else {
            $percentage = 0;
        }
        return round($percentage, 2);
    }

    //Get Certificates
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function pendingOrders()
    {
        $orders = Order::where('status', '=', 0)
            ->where('user_id', '=', $this->id)
            ->get();

        return $orders;
    }
    public function purchasedOrderItems()
    {
        $orders = Order::where('status', '=', 1)
            ->where('user_id', '=', $this->id)
            ->pluck('id');
        $courses_order_items = OrderItem::whereIn('order_id', $orders)
            ->where('item_type', '=', "App\Models\Course")
            ->get();
        return $courses_order_items;
    }
    public function purchasedCourses()
    {
        $orders = Order::where('status', '=', 1)
            ->where('user_id', '=', $this->id)
            ->pluck('id');
        $courses_id = OrderItem::whereIn('order_id', $orders)
            ->where('item_type', '=', "App\Models\Course")
            ->pluck('item_id');

        // dd($courses_order_items[0]->order);
        $courses = Course::whereIn('id', $courses_id)
            ->get();
        return $courses;
    }

    public function purchasedGroups()
    {
//        $orders = Order::where('status', '=', 1)
//            ->where('user_id', '=', $this->id)
//            ->pluck('id');
//        $groups_id = OrderItem::whereIn('order_id', $orders)
//            ->where('item_type', '=', "App\Models\Course")
//            ->pluck('item_group_id');
//        $groups = CourseGroup::whereIn('id', $groups_id)
//            ->get();
        $groups = CourseGroup::whereHas('students', function ($query) {
            $query->where('student_id', $this->id);
        })->get();

        return $groups;
    }

    public function purchasedBundles()
    {
        $orders = Order::where('status', '=', 1)
            ->where('user_id', '=', $this->id)
            ->pluck('id');
        $bundles_id = OrderItem::whereIn('order_id', $orders)
            ->where('item_type', '=', "App\Models\Bundle")
            ->pluck('item_id');
        $bundles = Bundle::whereIn('id', $bundles_id)
            ->get();

        return $bundles;
    }


    public function purchases()
    {
        $orders = Order::where('status', '=', 1)
            ->where('user_id', '=', $this->id)
            ->pluck('id');
        $courses_id = OrderItem::whereIn('order_id', $orders)
            ->pluck('item_id');
        $purchases = Course::where('published', '=', 1)
            ->whereIn('id', $courses_id)
            ->get();
        return $purchases;
    }

    public function findForPassport($user)
    {
        $user = $this->where('email', $user)->first();
        if ($user->hasRole('student')) {
            return $user;
        }
    }

    /**
     * Get the teacher profile that owns the user.
     */
    public function teacherProfile()
    {
        return $this->hasOne(TeacherProfile::class);
    }

    /**
     * Get the earning owns the teacher.
     */
    public function earnings()
    {
        return $this->hasMany(Earning::class, 'user_id', 'id');
    }

    /**
     * Get the withdraw owns the teacher.
     */
    public function withdraws()
    {
        return $this->hasMany(Withdraw::class, 'user_id', 'id');
    }

    public function AttendanceCourseLocation($course_id, $group, $lesson_id)
    {

        return $this->hasMany(Attendence::class, 'user_id')->where('course_group_id', $group)
            ->where('course_id', $course_id)
            ->where('lesson_id', $lesson_id);
    }
    public function getAttendanceStatus($group_id, $lesson_id)
    {
        $attendance = Attendence::where('user_id', $this->id)
            ->where('course_group_id', $group_id)
            ->where('lesson_id', $lesson_id)
            ->first();
        if ($attendance) {
            return $attendance->status;
        } else {
            return 0;
        }
    }

    public function courseLoc($course_id)
    {
        return $this->belongsToMany(Course::class, 'course_student')->withTimestamps()->where('course_id', '=', $course_id)->withPivot(['course_location_id']);
    }

    public static function findByName($name)
    {
        $nameParts = explode(' ', $name);

        $query = self::query();

        foreach ($nameParts as $index => $namePart) {
            if ($index == 0) {
                $query->where('first_name', 'LIKE', '%' . $namePart . '%');
            } elseif ($index == 1) {
                $query->orWhere('last_name', 'LIKE', '%' . $namePart . '%');
            } elseif ($index == 2) {
                $query->orWhere('third_name', 'LIKE', '%' . $namePart . '%');
            } elseif ($index == 3) {
                $query->orWhere('fourth_name', 'LIKE', '%' . $namePart . '%');
            }
        }

        $query->orWhere(DB::raw("CONCAT(first_name, ' ', last_name, ' ', third_name, ' ', fourth_name)"), 'LIKE', '%' . $name . '%');

        return $query->pluck('id');
    }

    public function getCertificateForCourse($course_id)
    {
        return $this->certificates()->where('course_id', $course_id)->first();
    }

    public function groups()
    {
        return $this->belongsToMany(CourseGroup::class, 'group_students', 'student_id', 'group_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
    public function hasSolvedTests()
    {
        return $this->results()->exists();
    }
    public function hasSolvedTest($testId)
    {
        return $this->results()->where('test_id', $testId)->exists();
    }
    public function getFullNameArAttribute()
    {
        return $this->name_ar . ' ' . $this->sec_name_ar . ' ' . $this->third_name_ar . ' ' . $this->fourth_name_ar;
    }

    //check if user data is filled
    // public function IsUserFilledData(){
    //     if($this->name_ar == null || $this->last_name_ar == null || $this->last_name == null
    //         || $this->email == null || $this->dob == null || $this->phone == null || $this->country == null
    //         || $this->city == null ){
    //         return false;
    //     }
    //     return true;
    // }
    // 
    public function IsUserFilledData()
    {
        //        if($this->name_ar == null || $this->sec_name_ar == null || $this->last_name == null
        //            || $this->email == null || $this->dob == null || $this->phone == null || $this->country == null
        //            || $this->city == null ){
        //            return false;
        //        }
        return true;
    }

    public function avatar()
    {
        //if user has avatar return it else return default avatar
        if ($this->avatar_location != null) {
            return $this->avatar_location;
        } else {
            $name = $this->full_name ?? $this->full_name_ar;
            return 'https://ui-avatars.com/api/?name=' . $name . '&color=ffff&background=EBF4FF&background=a0a0a0&rounded=true';
        }
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function activityResults()
    {
        return $this->hasMany(ActivityResult::class);
    }

    // Function to get the user's timezone offset
    function getUserTimezoneOffset($user) {
        return $user->timezone ?? '+00:00';
    }

    // Function to convert offset to a valid timezone string
    function convertOffsetToTimezone($offset) {
        $hours = intval(substr($offset, 0, 3));
        $minutes = intval(substr($offset, 4, 2));
        $timezone = timezone_name_from_abbr("", $hours * 3600 + $minutes * 60, 0);
        return $timezone ?: 'UTC';
    }

}
