<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Admin\StoreTeachersRequest;
use App\Http\Requests\Admin\UpdateTeachersRequest;
use App\Models\Auth\User;
use App\Models\Course;
use App\Models\Course_clints;
use App\Models\Location;
use App\Models\TeacherProfile;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\UserRepository;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class TeachersController extends Controller
{
    use FileUploadTrait;
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Display a listing of Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {

        if (request('show_deleted') == 1) {

            $users = User::role('teacher')->onlyTrashed()->get();
        } else {
            $users = User::role('teacher')->get();
        }

        $clients = Course_clints::all()->pluck('name_ar', 'id');
        $courses = Course::all()->pluck('name', 'id');
        $types = session('locale') == 'en' ? Type::where('status', 1)->pluck('name', 'id')->prepend(__('labels.backend.courses.fields.choose-cat'), '') : Type::where('status', 1)->pluck('name_ar', 'id')->prepend(__('labels.backend.courses.fields.choose-cat'), '');
        $locations = Location::all()->pluck('name', 'id');
        return view('backend.teachers.index', compact('users', 'types', 'clients', 'courses', 'locations'));
    }

    /**
     * Display a listing of Courses via ajax DataTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $teachers = "";


        if (request('show_deleted') == 1) {

            $teachers = User::role('teacher')->onlyTrashed()->orderBy('created_at', 'desc')->get();
        } else {
            $teachers = User::role('teacher')->orderBy('created_at', 'desc')->get();
        }

        if (auth()->user()->isAdmin()) {
            $has_view = true;
            $has_edit = true;
            $has_delete = true;
        }


        return DataTables::of($teachers)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                if ($request->show_deleted == 1) {
                    return view('backend.datatable.action-trashed')->with(['route_label' => 'admin.teachers', 'label' => 'teacher', 'value' => $q->id]);
                }

                if ($has_view) {
                    $view = view('backend.datatable.action-view')
                        ->with(['route' => route('admin.teachers.show', ['teacher' => $q->id])])->render();
                }

                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.teachers.edit', ['teacher' => $q->id])])
                        ->render();
                    $view .= $edit;
                }

                if ($has_delete) {
                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.teachers.destroy', ['teacher' => $q->id])])
                        ->render();
                    $view .= $delete;
                }

                $view .= '<a class="btn btn-warning mb-1" href="' . route('admin.groups.index', ['teacher_id' =>
                        $q->id]) . '">' . trans('labels.backend.group.title') . '</a>';

                return $view;

            })
            ->editColumn('status', function ($q) {
                $html = html()->label(html()->checkbox('')->id($q->id)
                ->checked(($q->active == 1) ? true : false)->class('switch-input')->attribute('data-id', $q->id)->value(($q->active == 1) ? 1 : 0).'<span class="switch-label"></span><span class="switch-handle"></span>')->class('switch switch-lg switch-3d switch-primary');
                return $html;
                // return ($q->active == 1) ? "Enabled" : "Disabled";
            })
            ->editColumn('name', function ($q) {
                return (app()->getLocale()=="ar")?($q->full_name_ar??$q->full_name):($q->full_name??$q->full_name_ar);
            })
            ->rawColumns(['actions', 'image', 'status'])
            ->make();
    }

    /**
     * Show the form for creating new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        return view('backend.teachers.create')
         ->withRoles($roleRepository->with('permissions')->get(['id', 'name']))
        ->withPermissions($permissionRepository->get(['id', 'name']));;
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param  \App\Http\Requests\StoreTeachersRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeachersRequest $request)
    {
//        $request = $this->saveFiles($request);
//        dd($request->all());
        $teacher = User::create($request->all());
        $teacher->confirmed = 1;
        if ($request->image) {
            $teacher->avatar_type = 'storage';
            $teacher->avatar_location = $request->image->store('/avatars', 'local');
        }
        $teacher->active = isset($request->active)?1:0;
        $teacher->save();
        $teacher->assignRole('teacher');

        $payment_details = [
            'bank_name'         => request()->payment_method == 'bank'?request()->bank_name:'',
            'ifsc_code'         => request()->payment_method == 'bank'?request()->ifsc_code:'',
            'account_number'    => request()->payment_method == 'bank'?request()->account_number:'',
            'account_name'      => request()->payment_method == 'bank'?request()->account_name:'',
            'paypal_email'      => request()->payment_method == 'paypal'?request()->paypal_email:'',
        ];
        $data = [
            'user_id'           => $teacher->id,
            'facebook_link'     => request()->facebook_link,
            'twitter_link'      => request()->twitter_link,
            'linkedin_link'     => request()->linkedin_link,
            'payment_method'    => request()->payment_method,
            'payment_details'   => json_encode($payment_details),
            'description'       => request()->description,
            'description_ar'       => request()->description_ar,
        ];
        TeacherProfile::create($data);

        $this->userRepository->update($teacher, $request->only(
            'first_name',
            'last_name',
            'email',
            'roles',
            'gender',
            'permissions',
            'national_id_number',
            'name_ar'
               
            ));
        return redirect()->route('admin.teachers.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }

    /**
     * Show the form for editing Category.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $teacher = User::findOrFail($id);
    //     return view('backend.teachers.edit', compact('teacher'));
    // }
    public function edit($id,ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository, User $user)
    {
        $teacher = User::findOrFail($id);

        return view('backend.teachers.edit',compact('teacher'))
            ->withUser($teacher)
            ->withRoles($roleRepository->get())
            ->withUserRoles($teacher->roles->pluck('name')->all())
            ->withPermissions($permissionRepository->get(['id', 'name']))
            ->withUserPermissions($teacher->permissions->pluck('name')->all());
    }
    /**
     * Update Category in storage.
     *
     * @param  \App\Http\Requests\UpdateTeachersRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeachersRequest $request, $id)
    {
//        $request = $this->saveFiles($request);

        $teacher = User::findOrFail($id);
        // update roles 
        $this->userRepository->update($teacher, $request->only(
            'first_name',
            'last_name',
            'email',
            'roles',
            'permissions',
            'national_id_number',
            'name_ar',
            'gender',
            'phone'
               
            ));
        // ///////////
        $teacher->update($request->except('email'));
        if ($request->has('image')) {
            $teacher->avatar_type = 'storage';
            $teacher->avatar_location = $request->image->store('/avatars', 'local');
        }
       
        $teacher->active = isset($request->active)?1:0;
        $teacher->save();

        $payment_details = [
            'bank_name'         => request()->payment_method == 'bank'?request()->bank_name:'',
            'ifsc_code'         => request()->payment_method == 'bank'?request()->ifsc_code:'',
            'account_number'    => request()->payment_method == 'bank'?request()->account_number:'',
            'account_name'      => request()->payment_method == 'bank'?request()->account_name:'',
            'paypal_email'      => request()->payment_method == 'paypal'?request()->paypal_email:'',
        ];
        $data = [
            // 'user_id'           => $user->id,
            'facebook_link'     => request()->facebook_link,
            'twitter_link'      => request()->twitter_link,
            'linkedin_link'     => request()->linkedin_link,
            'payment_method'    => request()->payment_method,
            'payment_details'   => json_encode($payment_details),
            'description'       => request()->description,
            'description_ar'       => request()->description_ar,
        ];
        if($teacher->teacherProfile){
            $teacher->teacherProfile->update($data);
        }
        else{
            $teacher->teacherProfile()->updateOrCreate($data);
        }
        
      
      

        return redirect()->route('admin.teachers.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    //filter teachers
    public function filterData(Request $request)
    {
        $types = Type::where('status', 1)->get()->pluck('name', 'id');
        $course_name = $request->course_name;
        $type = $request->type;
        $name = $request->name;
        $email = $request->email;
        $teachers = User::role('teacher');


        //get all teachers in this course
        if ($course_name){
            $teachers = $teachers->whereHas('courses', function ($query) use ($course_name) {
                //where its title or title_ar
                $query->where('title_ar', $course_name);
                $query->orWhere('title', $course_name);
            });
        }
        if ($type) {
            $teachers = $teachers->whereHas('courses', function ($query) use ($type) {
                $query->where('type_id', $type);
            });
        }

        if ($name) {
            $teacherIds = User::findByName($name);
            $teachers = $teachers->whereIn('id', $teacherIds);
        }

        if ($email) {
            $teachers = $teachers->where('email', 'like', '%' . $email . '%');
        }

        $teachers = $teachers->get();
        $courses = Course::all()->pluck('name', 'id');
        $users = $teachers;
        return view('backend.teachers.index', compact('users', 'types', 'courses'));

    }

    /**
     * Display Category.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = User::findOrFail($id);

        return view('backend.teachers.show', compact('teacher'));
    }


    /**
     * Remove Category from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $teacher = User::findOrFail($id);
        $teacher->delete();

        return redirect()->route('admin.teachers.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Category at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Category from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $teacher = User::onlyTrashed()->findOrFail($id);
        $teacher->restore();

        return redirect()->route('admin.teachers.index')->withFlashSuccess(trans('alerts.backend.general.restored'));
    }

    /**
     * Permanently delete Category from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {

        $teacher = User::onlyTrashed()->findOrFail($id);
        $teacher->teacherProfile->delete();
        $teacher->forceDelete();

        return redirect()->route('admin.teachers.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }


    /**
     * Update teacher status
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     **/
    public function updateStatus()
    {
        $teacher = User::find(request('id'));
        $teacher->active = $teacher->active == 1? 0 : 1;
        $teacher->save();
    }
}
