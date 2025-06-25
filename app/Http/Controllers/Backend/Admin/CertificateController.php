<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\CourseGroup;
use App\Models\CourseLocation;
use App\Notifications\Backend\CertificateApproval;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS2D;

class CertificateController extends Controller
{


    public function __construct()
    {

        $path = 'frontend';
        if (session()->has('display_type')) {
            if (session('display_type') == 'rtl') {
                $path = 'frontend-rtl';
            } else {
                $path = 'frontend';
            }
        } else if (config('app.display_type') == 'rtl') {
            $path = 'frontend-rtl';
        }
        $this->path = $path;
    }

    /**
     * Get certificates lost for purchased courses.
     */
    public function getCertificates()
    {


        $certificates = Certificate::all();
        $user = auth()->user();
        $isTeacher = $user->hasRole('teacher');
        if ($isTeacher) {
            $courses = $user->courses()->pluck('id')->toArray();

            $certificates = Certificate::whereIn('course_id', $courses)->get();
        }
        if (request('course_id') || request('course_location_id')) {

            $certificates = Certificate::where('course_id', request()->course_id)
                ->get();
            // dd($certificates[0]->course->locations->where('pivot.id',31));




        }
        $courses = session('locale') == 'ar' ? Course::pluck('title_ar', 'id')->prepend('اختر دورة', '') : Course::where('published', 1)->pluck('title', 'id')->prepend('Please select', '');

        return view('backend.certificates.admin', compact('certificates', 'courses'));
    }

    public function getCertByGroup(CourseGroup $group)
    {
        $course = $group->courses;
        $certificates = Certificate::where('group_id', $group->id)->get();
        return view('backend.certificates.admin2', compact('course',  'certificates', 'group'));
    }

    public function getCertByStudent(User $student)
    {
        $certificates = Certificate::where('user_id', $student->id)->get();
        return view('backend.certificates.admin2', compact('certificates', 'student'));
    }

    public function getCertificates2(Request $request)
    {


        $certificates = Certificate::all();
        $user = auth()->user();
        $isTeacher = $user->hasRole('teacher');
        if ($isTeacher) {
            $courses = $user->courses()->pluck('id')->whereHas('locations', function ($q) {
                $q->where('course_locations.id', request('course_location_id'));
            })->toArray();

            $certificates = Certificate::whereIn('course_id', $courses)->get();
        }

        if (request('course_id') || request('course_location_id')) {


            $certificates = Certificate::whereHas('course', function ($q) {

                $q->where('course_id', request()->course_id)
                    ->whereHas('locations', function ($q) {
                        $q->where('course_locations.id', request()->course_location_id);
                    });
            })->get();



            // $certificates=$certificates->course->locations->where('pivot.id',request('course_location_id'))->get();
            //  dd($certificates[0]->course->locations->where('pivot.id',1));



        }
        $courses = session('locale') == 'ar' ? Course::pluck('title_ar', 'id')->prepend('اختر دورة', '') : Course::where('published', 1)->pluck('title', 'id')->prepend('Please select', '');
        $currentCourseLocation = CourseLocation::find($request->course_location_id);
        $course = Course::find(request('course_id'));

        return view('backend.certificates.admin2', compact('course', 'currentCourseLocation', 'certificates', 'courses'));
    }
    public function showabrove_certificate()
    {

        $certificates = Certificate::where('show_to_user', '=', 0)->get();
        $user = auth()->user();
        $isTeacher = $user->hasRole('teacher');
        if ($isTeacher) {
            $courses = $user->courses()->pluck('id')->toArray();

            $certificates = Certificate::whereIn('course_id', $courses)->get();
        }
        if (request('course_id') || request('course_location_id')) {

            $certificates = Certificate::where('course_id', request()->course_id)
                ->get();
        }
        $courses = session('locale') == 'ar' ? Course::pluck('title_ar', 'id')->prepend('اختر دورة', '') : Course::where('published', 1)->pluck('title', 'id')->prepend('Please select', '');

        return view('backend.certificates.abrove', compact('certificates', 'courses'));
    }
    public function showabrove_certificate_online()
    {

        $certificates = Certificate::where('show_to_user', '=', 0)->get();
        $user = auth()->user();
        $isTeacher = $user->hasRole('teacher');
        if ($isTeacher) {
            $courses = $user->courses()->pluck('id')->toArray();

            $certificates = Certificate::whereIn('course_id', $courses)->get();
        }
        if (request('course_id') || request('course_location_id')) {

            $certificates = Certificate::where('course_id', request()->course_id)
                ->get();
            // dd($certificates[0]->course->locations->where('pivot.id',31));


        }
        $courses = session('locale') == 'ar' ? Course::pluck('title_ar', 'id')->prepend('اختر دورة', '') : Course::where('published', 1)->pluck('title', 'id')->prepend('Please select', '');

        return view('backend.certificates.abrove_online', compact('certificates', 'courses'));
    }

    public function abroveonline_all()
    {

        $certificate = Certificate::where('course_type', 1);
        $certificate->update(array('show_to_user' => 1));
        return back()->withFlashSuccess(' Certificate update Successfly');
    }

    public function abrove_all()
    {

        $certificate = Certificate::where('course_type', 3);
        $certificate->update(array('show_to_user' => 1));
        return back()->withFlashSuccess(' Certificate update Successfly');
    }

    /**
     * Download certificate for completed course
     */

    public function download(Request $request)
    {

        $certificate = Certificate::findOrFail($request->certificate_id);
        if ($certificate != null) {
            // dd($certificate->url);
            $file = public_path() . "/storage/certificates/" . $certificate->url;
            if (is_file($file)) {
                return Response::download($file);
            } else {
                $html_url = route('certificates.show', ['certificate' => $certificate->id]);
                save_pdf($html_url, $certificate->url);
                if (is_file($file)) {
                    return Response::download($file);
                }
                return back()->withFlashDanger('No Certificate found');
            }
        }
        return back()->withFlashDanger('No Certificate found');
    }

    /**
     * Generate certificate for completed course
     */
    public function show($id, Request $request)
    {


        $certificateAr = Certificate::where('id', $id)->with(['user', 'course'])->first();
        // $clientQrCode = $this->createQrCode('https://drive.google.com/file/d/1yGxU77E8cK9Hbn70CZS2BQKtENz2Fx5-/view?usp=sharing');
        $QrAr_name = 'Certificate-' . $certificateAr->course->id . '-' . auth()->user()->id . '-ar';

        $location = CourseLocation::where(['user_id' => auth()->user()->id, 'course_id' => $certificateAr->course->id])->first();
        $course = Course::findOrFail($certificateAr->course_id);

        $courseLocId = $course->whereHas('students', function ($query) use ($course) {
            $query->where('course_student.user_id', auth()->user()->id)->where('course_student.course_id', $course->id);
        })->first()->students()->first()->pivot->course_location_id;
        $location = CourseLocation::findOrFail($courseLocId);
        $data = [
            'name' => auth()->user()->name,
            'name_ar' => auth()->user()->name_ar,

            'course_name' => $certificateAr->course->title,
            'course_name_ar' => $certificateAr->course->title_ar,
            'date' => Carbon::now()->format('d M, Y'),

            'end_date' => Carbon::now()->format('d M, Y'),
            'start_date' => Carbon::parse($location->start_date)->format('d M, Y'),
            'user' => auth()->user(),
            'courseLocId' => $location->id,
            'course' => $course

        ];

        return view('certificate.index-ar', compact('certificateAr', 'data', 'QrAr_name'));
    }


    // Check if it exists, then re-generate

    public function checkifSerialexist($serial)
    {
        $CertificateNUM = Certificate::where('SN', $serial)->count();
        return ($CertificateNUM > 0);
    }
    public function destroy($id)
    {

        $certificate = Certificate::find($id);
        $user = User::find($certificate->user_id);
        $user->is_certified_by_admin = 0;
        $user->save();
        //delete the certificate pdf
        $file = public_path() . "/storage/certificates/" . $certificate->url;
        if (is_file($file)) {
            unlink($file);
        }

        $certificate->delete();
        return back()->withFlashSuccess(' Certificate Delete Successfly');
    }
    public function updateshow($certificate_id)
    {
        $certificate = Certificate::where('id', $certificate_id);
        // $certificate->show_to_user=1;

        $certificate->update(array('show_to_user' => 1));
        return back()->withFlashSuccess(' Certificate update Successfly');
    }
    public function updateshow2(Request $request)

    {
        $val = $request->forms;

        // Certificate::whereIn('id',$request->input('certid'))->update(['show_to_user' =>(array)$val] );

        // Certificate::whereIn('id ',(array)$request->input('certid'))->update(array('show_to_user' =>$val ));
        // Certificate::whereIn('id ',(array)$request->input('certid'))->update(array('show_to_user'=>0));


        foreach ($request->input('certid') as $key => $cert) {
            # code...

            Certificate::where('id', $cert)->update(['show_to_user' => (int)$val[$key]]);
        }
        // Certificate::update(array('show_to_user' =>$val ));


        // $certificate= new Certificate;
        //     $certificateids= Certificate::pluck('id')->toArray();
        //     // $certificate->show_to_user=1;
        // //   dd($certificate);
        //   $AllFormsIdsToSync = array_merge($certificateids, (array)$request->input('forms'));
        //     // $certificate->sync(array_filter($AllFormsIdsToSync));

        //     $AllFormsIdsToSync->update(array('show_to_user' => 1));
        return back()->withFlashSuccess(' Certificate update Successfly');
    }

    public function approveStudent(Certificate $certificate){
        $certificate->update(array('show_to_user' => 1));
        //Notify student
        $certificate->user->notify(new CertificateApproval());
        return back()->withFlashSuccess(' Certificate update Successfly');
    }
}
