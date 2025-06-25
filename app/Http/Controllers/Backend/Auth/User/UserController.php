<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Mail\groupEmail;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Models\CourseGroup;
use App\Notifications\Backend\AddedStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\Backend\Auth\User\UserDeleted;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\UserRepository;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Http\Requests\Backend\Auth\User\StoreUserRequest;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Http\Requests\Backend\Auth\User\UpdateUserRequest;
use App\Jobs\SendEmailJob;
use App\Mail\courseEmail;
use App\Models\Coordinator;
use App\Models\Course;
use App\Models\CourseLocation;
use App\Models\Order;
use App\Models\TeacherProfile;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController.
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageUserRequest $request)
    {
        if (!\Gate::allows('user_access')) {
            return abort(401);
        }
        $roles = Role::select('id', 'name')->get();

        return view('backend.auth.user.index', compact('roles'))
            ->withUsers($this->userRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Display a listing of Courses via ajax DataTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        if ($request->role &&  $request->role != "") {
            $users = User::role($request->role)->with('roles', 'permissions', 'providers')
                ->orderBy('users.created_at', 'desc');
        } else {
            $users = User::with('roles', 'permissions', 'providers')
                ->orderBy('users.created_at', 'desc');
        }

        return \DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('confirmed_label', function ($q) {
                return $q->confirmed_label;
            })
            ->addColumn('roles_label', function ($q) {
                return ($q->roles_label) ?? 'N/A';
            })
            ->addColumn('permissions_label', function ($q) {
                return ($q->permission_label) ?? 'N/A';
            })
            ->addColumn('social_buttons', function ($q) {
                return ($q->social_buttons) ?? 'N/A';
            })
            ->addColumn('updated_at', function ($q) {
                \Log::info($q);

                return $q->updated_at->diffForHumans();
            })
            ->addColumn('last_updated', function ($q) {
                return $q->updated_at->diffForHumans();
            })
            ->addColumn('actions', function ($q) {

                return $q->action_buttons;
            })
            ->rawColumns(['confirmed_label', 'roles_label', 'permissions_label', 'social_buttons', 'actions'])
            ->make();
    }
    public function  addUserToCourse(Request $request, $user)
    {
        $courses = session('locale') == 'ar' ? Course::where('published', 1)->pluck('title_ar', 'id')->prepend('اختر دورة', '') : Course::where('published', 1)->pluck('title', 'id')->prepend('Please select', '');
        return view('backend.auth.user.add_to_course', compact('user', 'courses'));
    }
    public function addUserToGroup(Request $request, $user)
    {
        $groups = session('locale') == 'ar' ? CourseGroup::pluck('title_ar', 'id')->prepend('اختر مجموعه', '') :
            CourseGroup::pluck('title', 'id')->prepend('Please select', '');
        return view('backend.auth.user.add_to_group', compact('user', 'groups'));
    }
    public function addUserToCourseAjax($user, $course_id)
    {

        $courseLocation = session('locale') == 'ar' ? Course::find($course_id)->locations->pluck('name_ar', 'pivot.id')->prepend('اختر موقع الدوره', '') : Course::find($course_id)->locations->pluck('name', 'pivot.id')->prepend('choose Course Location  ', '');

        return json_encode($courseLocation);
    }
    public function storeUserToCourse(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        $isINCourse = $course->whereHas('students', function ($q) use ($request) {

            return $q->where('course_student.user_id', '=', $request->user_id)->where('course_student.course_location_id', $request->course_location_id);
        })->get();
        $courseLocation = CourseLocation::find($request->course_location_id);
        $CourseCoordinators = $courseLocation->coordinators;
        if (count($isINCourse) == 0) {
            try {
                $course->students()->attach($request->user_id, ['course_location_id' => $request->course_location_id]);
                $course->save();
                // return redirect()->back()->with('success', 'User Added Successfly to course'); 
                $order = $this->makeOrder($request->user_id, $course, $request->course_location_id);

                $student = User::find($request->user_id);

                $content = [];
                $content['course_name'] = $course->title_ar;
                $content['course_slug'] = $course->slug;
                $content['email'] = $student->email;
                $content['student'] = $student;
                $content['teachers'] = $course->teachers;
                $content['locations'] = $course->locations;
                $content['courseLocation'] = $courseLocation;

                // \Mail::to($student->email)->send(new courseEmail($content));
                $message = trans('labels.backend.courses.join_message') . $course->title_ar .
                    trans('labels.backend.courses.join_message_info') . route('frontend.index');
                if ($request->send_email) {
                    dispatch(new SendEmailJob($student->email, $content));
                    foreach ($CourseCoordinators as $key => $coordinator) {
                        # code...
                        dispatch(new SendEmailJob($coordinator->email, $content));
                    }
                    dispatch(new SendEmailJob('tr_coordinator@ivorytraining.com', $content));
                    $result = SendSMS(['Message' => $message, 'RecepientNumber' => str_replace('+', '00', $student->phone)]);
                }

                //    
                if ($order)
                    return redirect()->back()->withFlashSuccess(' User Added Successfly to course');
                else
                    return redirect()->back()->withFlashSuccess(' Error in add course');

                //code...
            } catch (\Throwable $th) {
                //throw $th;
            return redirect()->back()->withFlashDanger(__('alerts.backend.general.try_again'));

            }
        } else {
            // return redirect()->back()->with('error', 'User already in  course'); 
            return redirect()->back()->withFlashDanger(' User already in  course');
        }
    }

    public function storeUserToGroup(Request $request)
    {
        $group = CourseGroup::findOrFail($request->group_id);

            $student = User::findOrfail($request->user_id);
            if ($student) {
                //check if the student is already in the group or not
                if ($group->students->contains($student->id)) {
                    return redirect()->back()->withFlashDanger('الطالب موجود بالفعل في المجموعة');
                }else{

                    $group->students()->attach($student->id);

                    //send email foreach student
                    if ($request->send_email == 'on') {
                        $content = [
                            'group_id' => $group->id,
                            'group_name' => $group->title_ar,
                            'course_name' => $group->courses->title_ar,
                            'course_slug' => $group->courses->slug,
                        ];
                        \Mail::to($student->email)->send(new groupEmail($content));
                        // Notify Student
                        $student->notify(new AddedStudent($group));
                    }
                }
                return redirect()->back()->withFlashSuccess('تم اضافة الطلاب بنجاح');
            }


    }

    public function makeOrder($user_id, $course, $courseLocation_id)
    {
        $courseLocation = CourseLocation::findOrFail($courseLocation_id);

        $order = new Order();
        $order->user_id = $user_id;
        $order->reference_no = str_random(8);
        $order->amount = $courseLocation->price;
        $order->status = 1;
        $order->coupon_id = 0;

        $order->payment_type = 3; //manual
        $order->status = 1;
        $order->save();
        //Getting and Adding items

        $type = Course::class;
        $order->items()->create([
            'item_id' => $course->id,
            'item_type' => $type,
            'price' => $courseLocation->price,
            'item_location_id' => $courseLocation_id
        ]);
        return $order;
    }
    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        if(app()->getLocale()=="ar"){
   
            $coordinators=Coordinator::all()->pluck('name_ar', 'id');
        }
        else{
           
            $coordinators=Coordinator::all()->pluck('name', 'id');
            
        }
        return view('backend.auth.user.create',compact('coordinators'))
            ->withRoles($roleRepository->with('permissions')->get(['id', 'name']))
            ->withPermissions($permissionRepository->get(['id', 'name']));
    }

    /**
     * @param StoreUserRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreUserRequest $request)
    {
        $user=$this->userRepository->create($request->only(
            'first_name',
            'last_name',
            'third_name',
            'fourth_name',
            'name_ar',
            'sec_name_ar',
            'third_name_ar',
            'fourth_name_ar',
            'email',
            'password',
            'active',
            'confirmed',
            'confirmation_email',
            'roles',
            'phone',
            'permissions',
            'gender',
            'job',
            'country',
            'city',
            'national_id_number'
        ));
        
        $message = 'تم اضافة مستخدم لك في مركز العاج الفضي للتدريب باسم مستخدم ' . ' '
            . '[' . $request->email . ']' . 'ورقم سري' . '[' . $request->password . '] ' .
            trans('labels.backend.courses.join_message_info') . ' ' . route('frontend.index');
        $result = SendSMS(['Message' => $message, 'RecepientNumber' => str_replace('+', '00', $request->phone)]);
        $content = [];
        $content['course_name'] = null;
        $content['course_slug'] = null;
        $content['email'] = $request->email;
        $content['password'] = $request->password;
        $content['student'] = User::find($user->id)?User::find($user->id):null;
        
        // dispatch(new SendEmailJob($request->email,$content));
        if ($request->send_email_to_user){
            try {
                \Mail::to($request->email)->send(new courseEmail($content));
            } catch (\Throwable $th) {
                //throw $th;
            }
            if($request->coordinator){
                $coordinatorsObj=Coordinator::whereIn('id',$request->coordinator)->get();
               
            foreach ($coordinatorsObj as $key => $coordinator) {
                # code...
              
                dispatch(new SendEmailJob($coordinator->email, $content));
            }
        }
            dispatch(new SendEmailJob('tr_coordinator@ivorytraining.com', $content));
        }

        if ($request->has('type')){
            return redirect()->route('admin.group.students.all')->withFlashSuccess(__('alerts.backend.users.created'));
        }
        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.created'));
    }
    

    
    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @return mixed
     */
    public function show(ManageUserRequest $request, User $user)
    {
        return view('backend.auth.user.show')
            ->withUser($user);
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository, User $user)
    {
        return view('backend.auth.user.edit')
            ->withUser($user)
            ->withRoles($roleRepository->get())
            ->withUserRoles($user->roles->pluck('name')->all())
            ->withPermissions($permissionRepository->get(['id', 'name']))
            ->withUserPermissions($user->permissions->pluck('name')->all());
    }

    /**
     * @param UpdateUserRequest $request
     * @param User              $user
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // dd(request()->all());

        $this->userRepository->update($user, $request->only(
            'first_name',
            'last_name',
            'third_name',
            'fourth_name',
            'name_ar',
            'sec_name_ar',
            'third_name_ar',
            'fourth_name_ar',
            'email',
            'roles',
            'permissions',
            'gender',
            'national_id_number',
            'name_ar',
            'sec_name_ar',
            'third_name_ar',
            'fourth_name_ar',
            'job',
            'country',
            'city',
            'phone'
        )); 

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.updated'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageUserRequest $request, User $user)
    {
        $this->userRepository->deleteById($user->id);

        event(new UserDeleted($user));

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.deleted'));
    }
    public function BinaryFlag($id)
    {
        $user = User::findOrFail($id);
        if ($user->is_binary_name == 1) {
            $user->is_binary_name = 0;
        } else {
            $user->is_binary_name = 1;
        }
        $user->save();

        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }
    public function updateBinaryFlag()
    {
        $user = User::findOrFail(request('id'));
        $user->is_binary_name = $user->is_binary_name == 1? 0 : 1;
        $user->save();
    }
    public function saveUserFromLanding(Request $request) {
        // return($request->all());
        $isExist=User::where('email',$request->email)->first();
        $hashed_random_password = str_random(8);
        $name=explode(' ',$request->user_name);
        $data=[];
        $data['first_name']=$name[0];
        $data['last_name']=$name[1]??'NULL';
        $data['third_name']=$name[2]??'NULL';
        $data['name_ar']=$name[0];
        $data['email']=$request->email;
        $data['password']=$hashed_random_password;
        $data['active']=1;
        $data['roles']=['student'];
        $data['phone']=$request->phone;
        $data['confirmed']=1;
        $newUser2=$isExist;
        if(!$isExist){
            $newUser2= User::create([
                'first_name'=> $data['first_name'],
                'last_name'=>$data['last_name'],
                'third_name'=>$data['third_name'],
                'name_ar'=>$data['name_ar'],
                'email'=>$data['email'],
                'password'=>$data['password'],
                'active'=>$data['active'],
                'confirmed'=>$data['confirmed'],
                'phone'=>$data['phone'],
    
    
            ]);
            $newUser2->syncRoles($data['roles']);
            $content = [];
           
            $content['course_name'] = $request->course_name;
            $content['start_date'] = $request->start_date;
            $content['end_date'] = $request->end_date;

            $content['course_slug'] = null;
            $content['email'] = $request->email;
            $content['password'] = $data['password'];
            $content['student'] = $newUser2;
            try {
                \Mail::to($request->email)->send(new courseEmail($content));
            } catch (\Throwable $th) {
                //throw $th;
            }

            
        }
        
        return($newUser2);
     }
}
