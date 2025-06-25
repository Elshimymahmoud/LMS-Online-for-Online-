<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Mail\certificateEmail;
use App\Models\Certificate;
use App\Models\CertificateTemplates;
use App\Models\Course;
use App\Models\CourseGroup;
use App\Models\CourseGroupImpact;
use App\Models\CourseGroupRates;
use App\Models\UserCourseRate;
use App\Models\UserCourseForm;
use Jenssegers\Date\Date;

use Carbon\Carbon;
use Dompdf\Dompdf;
//use Barryvdh\DomPDF\Facade as PDF;
use PDF;
use ArPHP\I18N\Arabic;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS2D;
use App\Models\Auth\User;
use App\Models\CourseForms;
use App\Models\CourseLocation;
use I18N_Arabic_Glyphs;
// use App\Helpers\I18N\Arabic\I18N_Arabic_Glyphs;

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

        $certificates = auth()->user()->certificates;
        return view('backend.certificates.index', compact('certificates'));
    }
    public function getCertificates2()
    {
        $certificates = auth()->user()->certificates->where('show_to_user', '=', 1);
        return view('backend.certificates.index2', compact('certificates'));
    }

    /**
     * Generate certificate for completed course
     */
    public function generate_certificate_from_admin($group_id, $student_id)
    {
        $group = CourseGroup::findOrFail($group_id);
        $template = CertificateTemplates::findOrFail($group->cert_template->id);
        $course_id = $group->courses->id;
        $course_type = $group->courses->type_id;
        $serial = $this->GenerateSerial();
        while ($this->checkifSerialexist($serial)) {
            $serial = $this->GenerateSerial();
        }
        
        $certificate = Certificate::firstOrCreate([
            'user_id' => $student_id,
            'course_id' => $course_id,
            'group_id' => $group->id,
            'type' => session('locale'),
        ]);

        $certificate->SN = $serial;
        
        $certificate_name = 'Certificate-' . $course_id . '-' . $student_id . '-' . session('locale') . '.pdf';
        $Qr_name = 'Certificate-' . $course_id . '-' . $student_id . '-' . session('locale');
        
        // Update certificate name and URL
        $certificate->name = $certificate_name;
        $certificate->url = $certificate_name;

        // Determine show_to_user based on course type
        if ($course_type == 3 || $course_type == 2) {
            $certificate->show_to_user = 0;
        } else {
            $certificate->show_to_user = 1;
        }

        $certificate->course_type = $course_type;
        $certificate->save();
        
        // Generate QR code
        $qrContent = asset('storage/certificates/' . $certificate_name);
        Storage::disk('Qr')->put("qrCodes/" . $Qr_name . '.svg', DNS2D::getBarcodeSVG($qrContent, 'QRCODE'));
        $qrImage = asset('storage/qrCodes/' . $Qr_name . '.svg');
        $parameters['type'] = $template->type;
        $parameters['image'] = $template->bg_image;
        $parameters['code'] = $template->content;
        $parameters['cert'] = $certificate;
        $parameters['qr_width'] = $template->qr_width;
        $parameters['qr_height'] = $template->qr_height;
        $parameters['qr_code'] = $Qr_name . '.svg';
        $parameters['code_print'] = $template->content;
        $parameters['group'] = $group;
        $html = $this->htmlGenerator($parameters);


//        if($course_type == 3){
//            $html_url = $this->showCertificates2($certificate->id, true)->render();
//        }else{
//            $html_url = $this->showCertificates($certificate->id, false)->render();
//        }

//
    //    $arabic = new Arabic();
    //    $p = $arabic->arIdentify($html);
    //    for ($i = count($p)-1; $i >= 0; $i-=2) {
    //        $utf8ar = $arabic->utf8Glyphs(substr($html, $p[$i-1], $p[$i] - $p[$i-1]));
    //        $html = substr_replace($html, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
    //    }

    //    $pdf = PDF::loadHTML($html);
    //    $pdf->setPaper('A4', 'landscape');
    //    //reduse the width of the pdf
    //    $pdf->setOptions(['isPhpEnabled' => true]);
    //    $pdf->setOptions(['isHtml5ParserEnabled' => true]);
    //    $pdf->setOptions(['isRemoteEnabled' => true]);

        // if ( ! class_exists( 'I18N_Arabic' ) ){

        // // require_once(__DIR__ . "Helpers/I18N/Arabic/Glyphs.php" );
        // // dd(__DIR__ . "/../Helpers/I18N/Arabic/Glyphs.php");
        // $Arabic = new I18N_Arabic_Glyphs('Glyphs');
        // $html = $Arabic->utf8Glyphs($html);
        // }
        

        // $arabic = new Arabic();
        //     $p = $arabic->arIdentify($html);

        //     for ($i = count($p) - 1; $i >= 0; $i -= 2) {
        //      $utf8ar = $arabic->utf8Glyphs(substr($html, $p[$i - 1], $p[$i] - $p[$i - 1]));
        //      $html = substr_replace($html, $utf8ar, $p[$i - 1], $p[$i] - $p[$i - 1]);
        //     }

        // $arabic = new Arabic();
        // $p = $arabic->arIdentify($html);
        // for ($i = count($p)-1; $i >= 0; $i-=2) {
        //     $utf8ar = $arabic->utf8Glyphs(substr($html, $p[$i-1], $p[$i] - $p[$i-1]));
        //     $html = substr_replace($html, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
        // }


        // $html = '<html lang="ar" dir="rtl">
        //             <head>
        //                 <meta charset="utf-8">
        //                 <style>
        //                     body {
        //                         font-family: "Amiri", sans-serif;
        //                     }
        //                 </style>
        //             </head>
        //             <body>
        //                 <h1>مرحبا بكم</h1>
        //                 <p>هذا نص باللغة العربية.</p>
        //             </body>
        //          </html>';

        $html = view('backend.certificates.templates.view',$parameters)->render();
        $arabic = new Arabic();
        $p = $arabic->arIdentify($html);
        
        for ($i = count($p)-1; $i >= 0; $i-=2) {
            $utf8ar = $arabic->utf8Glyphs(substr($html, $p[$i-1], $p[$i] - $p[$i-1]),1000,true,true);
            $html = substr_replace($html, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
        }

        // $reportHtml = view('admin.reports.cutomReport', []);
        // $reportHtml = view('backend.certificates.templates.view',$parameters)->render();

        $pdf = PDF::loadHTML($html);
        $pdf->setOptions(['dpi' => 250]);
        $pdf->setPaper('A3', 'landscape');



        // Delete previous certificate file if exists
        $certificateFilePath = Storage::disk('Qr')->put("certificates/" . $certificate_name, $pdf->output());
        if (\File::exists($certificateFilePath)) {
            \File::delete($certificateFilePath);
        }
        Storage::disk('Qr')->put("certificates/" . $certificate_name, $pdf->output());

        return back();

    }

    private function htmlGenerator($parameters)
    {
        return view('backend.certificates.templates.view',$parameters);
    }

    /**
     * Generate certificate for completed course
     */
    public function generateCertificate(Request $request)
    {
        $group = CourseGroup::find($request->group_id);
        $unfinishedForms = [];
        foreach ([ 'rates', 'impacts', 'reccomendations'] as $formType) {
            $solved = false; // Flag to track if at least one question is solved for this form type

            foreach ($group->$formType as $form) {
                if($formType == 'rates'){
                    if($form->user_type == 'student') {

                        foreach($form->divisions as $item){
                            $answer = $item->questions->map(function ($question) use ($item, $request) {
                                return $question->answers->where('user_id', \Auth::id())
                                    ->where('group_id', $request->group_id)
                                    ->isEmpty();
                            })->flatten();

                            if ($answer->contains(false)) {
                                $solved = true; // Set flag to true if at least one question is solved
                                break 2; // Break out of both foreach loops
                            }
                        }
                    }
                }else{
                    foreach ($form->questions as $question) {
                        $answer = $question->answers()->where('user_id', auth()->user()->id)->where('group_id', $request->group_id)->first();

                        if (!empty($answer)) {
                            $solved = true; // Set flag to true if at least one question is solved
                            break 2; // Break out of both foreach loops
                        }
                    }
                }

            }

            if (!$solved) {
                $unfinishedForms[] = $formType;
            }
        }
//        dd($unfinishedForms);
        if (!empty($unfinishedForms)) {
            return back()->with('showCategory', $unfinishedForms[0])->withFlashDanger(trans('alerts.frontend.complete_all_forms_'. $unfinishedForms[0]));
        }

        $group = CourseGroup::find($request->group_id);
        $template = CertificateTemplates::findOrFail($group->cert_template->id);
        $isStudentInGroup = $group->students()->where('users.id', auth()->user()->id)->get();
        $course = Course::where('id', $request->course_id)->first();
        if (($course != null) && $group && $isStudentInGroup && ($course->progress($request->group_id) >= 50)) {
            $serial = $this->GenerateSerial();
            while ($this->checkifSerialexist($serial)) {
                $serial = $this->GenerateSerial();
            }

            $certificate = Certificate::firstOrCreate([
                'user_id' => auth()->user()->id,
                'course_id' => $request->course_id,
                'group_id' => $request->group_id,
                'type' => session('locale'),

            ]);
            $certificate->SN = $serial;

            if ($course->type_id == 1) {
                $certificate->show_to_user = 1;
            }




            $certificate_name = 'Certificate-' . $course->id . '-' . auth()->user()->id . '-' . session('locale') . '.pdf';
            $Qr_name = 'Certificate-' . $course->id . '-' . auth()->user()->id . '-' . session('locale');
            $certificate->name = auth()->user()->id;
            $certificate->url = $certificate_name;
            $certificate->save();




            // /////Arabic cerificate//////
            $serial = $this->GenerateSerial();
            while ($this->checkifSerialexist($serial)) {
                $serial = $this->GenerateSerial();
            }



            // ///////////////////////////generate qr///////////////
            Storage::disk('Qr')->put("qrCodes/" . $Qr_name . '.svg', DNS2D::getBarcodeSVG(asset('storage/certificates/' . $certificate_name), 'QRCODE'));

            // /////////////////////////////Generate certificate PDF AR and EN///////////
//            $html_url = $this->showCertificates($certificate->id, false)->render();
//
//            $arabic = new Arabic();
//            $p = $arabic->arIdentify($html_url);
//            for ($i = count($p)-1; $i >= 0; $i-=2) {
//                $utf8ar = $arabic->utf8Glyphs(substr($html_url, $p[$i-1], $p[$i] - $p[$i-1]));
//                $html_url = substr_replace($html_url, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
//            }

            $parameters['type'] = $template->type;
            $parameters['image'] = $template->bg_image;
            $parameters['code'] = $template->content;
            $parameters['cert'] = $certificate;
            $parameters['qr_width'] = $template->qr_width;
            $parameters['qr_height'] = $template->qr_height;
            $parameters['code_print'] = $template->content;
            $parameters['qr_code'] = $Qr_name . '.svg';
            $parameters['group'] = $group;

            $html = view('backend.certificates.templates.view',$parameters)->render();
            $arabic = new Arabic();
            $p = $arabic->arIdentify($html);

            for ($i = count($p)-1; $i >= 0; $i-=2) {
                $utf8ar = $arabic->utf8Glyphs(substr($html, $p[$i-1], $p[$i] - $p[$i-1]),1000,true,true);
                $html = substr_replace($html, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
            }

            $pdf = PDF::loadHTML($html);
            $pdf->setOptions(['dpi' => 250]);
            $pdf->setPaper('A4', 'landscape');


//            $pdf = PDF::loadHTML($html_url);
//            $pdf->setPaper('A4', 'landscape');
//            //reduse the width of the pdf
//            $pdf->setOptions(['isPhpEnabled' => true]);
//            $pdf->setOptions(['isHtml5ParserEnabled' => true]);
//            $pdf->setOptions(['isRemoteEnabled' => true]);

            Storage::disk('Qr')->put("certificates/" . $certificate_name, $pdf->output());


            // $html_url="https://courses.e-9.co/test-cert";  //for local test
            //            save_pdf($html_url, $certificate_name);
            $content = [];
            $content['user'] = auth()->user();
            $content['cert'] = $certificate;

            // dispatch(new SendEmailJob(auth()->user()->email,$content,'generate_certificate'));
            // try {
            //     //code...
            //     \Mail::to(auth()->user()->email)->send(new certificateEmail($content));
            // } catch (\Throwable $th) {
            //     //throw $th;
            //     return redirect()->route('certificate.success', ['certificate' => $certificate->id])->withFlashSuccess(trans('alerts.frontend.course.completed'));
            // }

            return redirect()->route('certificate.success', ['certificate' => $certificate->id])->withFlashSuccess(trans('alerts.frontend.course.completed'));
        }


        return abort(404);
    }
    public function generateCertificateById($id)
    {




        $certificate = Certificate::find($id);





        // /////////////////////////////Generate certificate PDF AR and EN///////////
        $html_url = route('certificates.show', ['certificate' => $certificate->id]);
        // $html_url="https://courses.e-9.co/test-cert";  //for local test

        save_pdf($html_url, $certificate->url);
        $content = [];
        $content['user'] = auth()->user();
        $content['cert'] = $certificate;

        // dispatch(new SendEmailJob(auth()->user()->email,$content,'generate_certificate'));
        try {
            //code...
            \Mail::to(auth()->user()->email)->send(new certificateEmail($content));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('certificate.success', ['certificate' => $certificate->id])->withFlashSuccess(trans('alerts.frontend.course.completed'));
        }

        return redirect()->route('certificate.success', ['certificate' => $certificate->id])->withFlashSuccess(trans('alerts.frontend.course.completed'));
    }
    public function showCertificates($certificate, $direct = false)
    {



        $certificate = Certificate::findOrFail($certificate);

        $course = Course::findOrFail($certificate->course_id);
        $teachers = implode(',', $course->teachers->pluck('fullname')->toArray());
        $user = User::findOrFail($certificate->user_id);
        $group = CourseGroup::findOrfail($certificate->group_id);



        // get month in arabic
        $courseStartDate = Carbon::parse($group->start)->format('Y-M-d');
        $courseendDate = Carbon::parse($group->end)->format('Y-M-d');

        $NowDate = Carbon::now()->format('Y-M-d');
        if ($certificate->type == "ar") {
            Date::setLocale('ar');
            $start_date = Date::parse($group->start)->format('M d');
            $end_date = Date::parse($group->end)->format('M d');
            $MonthStart = $this->getMonthInArabic($courseStartDate);
            $Monthend = $this->getMonthInArabic($courseendDate);
            $MonthNow = $this->getMonthInArabic($NowDate);
        } else {
            $start_date = Date::parse($group->start)->format('M d');
            $end_date = Date::parse($group->end)->format('M d');
            $MonthStart = Carbon::parse($group->start)->format('M');
            $Monthend = Carbon::parse($group->end)->format('M');

            $MonthNow = Carbon::now()->format('M');
        }
        $name = $user->first_name . " " . $user->last_name . " " . $user->third_name . " " . $user->fourth_name;
        $name_ar = $user->name_ar . " " . $user->sec_name_ar . " " . $user->third_name_ar . " " . $user->fourth_name_ar;
        $bootstrap4 = file_get_contents(public_path() . '/cert/bootstrap.min.css');
        $fontawesome = file_get_contents(public_path() . '/cert/css2.css');

        $data = [
            'name' => $name,
            'name_ar' => $name_ar,

            'course_name' => $course->title,
            'date' => Carbon::now()->format('d/m/Y'),
            // //////new data///
            'course_name_ar' => $course->title_ar,
            'end_date' => $end_date,
            'start_date' =>$start_date,
            'end_date_en' => Carbon::parse($group->end)->format('d') . ' ' . Carbon::parse($group->end)->format('M')
                . ' ' . Carbon::parse($group->end)->format('Y'),
            'start_date_en' => Carbon::parse($group->start)->format('d') . ' ' . Carbon::parse($group->start)
                    ->format('M'),
            'end_date_en_two' => Carbon::parse($group->end)->format('d/m/Y'),
            'bootstrap4' => $bootstrap4,
            'fontawesome' => $fontawesome,

            'user' => $user,
            'location' => $course->type_id == 2 ? 'Online' : $group->name_ar,
            'teachers' => $teachers,
            'group' => $group,
            'course' => $course
        ];

        $Qr_name = 'Certificate-' . $course->id . '-' . $user->id . '-' . $certificate->type;

        if ($certificate->type == "ar") {
            if ($course->type_id == 3) { //حضوري
                return  view('certificate.index-ar-direct', compact('certificate', 'data', 'Qr_name', 'direct', 'course'));
            } elseif ($course->type_id == 4) { //ملتقي
                return  view('certificate.index-meeting', compact('certificate', 'data', 'Qr_name', 'direct', 'course'));
            } else {

                return  view('certificate.index-ar', compact('certificate', 'data', 'Qr_name', 'direct', 'course'));
            }
        } else {
            if ($course->type_id == 3) { //حضوري
                return  view('certificate.index-ar-direct', compact('certificate', 'data', 'Qr_name', 'direct', 'course'));
            }
            return  view('certificate.index-en', compact('certificate', 'data', 'Qr_name', 'direct', 'course'));
        }
    }
    // *****
    public function showCertificates2($certificate, $direct = false)
    {

        $certificate = Certificate::findOrFail($certificate);

        $course = Course::findOrFail($certificate->course_id);
        $group = CourseGroup::findOrfail($certificate->group_id);
        $teachers = implode(',', $course->teachers->pluck('fullname')->toArray());
        $user = User::findOrFail($certificate->user_id);
        $group = CourseGroup::findOrfail($certificate->group_id);

        // $location=CourseLocation::where(['user_id'=>$user->id,'course_id'=>$course->id])->first();


        $max = DB::table('attendences')->select('attendance_time')
            ->where('user_id', '=', $certificate->user_id)
            ->where('course_id', '=', $certificate->course_id)
            ->where('course_group_id', '=', $certificate->group_id)

            ->orderBy('attendance_time', 'desc')->first();

        $min = DB::table('attendences')->select('attendance_time')
            ->where('user_id', '=', $certificate->user_id)
            ->where('course_id', '=', $certificate->course_id)
            ->where('course_group_id', '=', $certificate->group_id)
            ->orderBy('attendance_time', 'asc')->first();


        $bootstrap4 = file_get_contents(public_path() . '/cert/bootstrap.min.css');
        $fontawesome = file_get_contents(public_path() . '/cert/css2.css');

        if ($min == Null) {
            return  view('certificate.index-ar-direct-3');
        } else {
            $courseendDate = Carbon::parse($max->attendance_time)->format('Y-m-d ');
            $courseStartDate = Carbon::parse($min->attendance_time)->format('Y-m-d ');

            $NowDate = Carbon::now()->format('Y-M-d');
            if ($certificate->type == "ar") {
                $MonthStart = $this->getMonthInArabic($courseStartDate);
                $Monthend = $this->getMonthInArabic($courseendDate);

                $MonthNow = $this->getMonthInArabic($NowDate);
            } else {
                $MonthStart = Carbon::parse($group->start)->format('M');
                $Monthend = Carbon::parse($group->end)->format('M');

                $MonthNow = Carbon::now()->format('M');
            }
            $name = $user->full_name;
            $name_ar = $user->full_name_ar;
            $data = [
                'name' => $name,
                'name_ar' => $name_ar,

                'course_name' => $course->title,
                'date' => Carbon::now()->format('d/m/Y'),
                // //////new data///
                'course_name_ar' => $course->title_ar,
                'end_date' => Carbon::parse($max->attendance_time)->format('d') . ' ' . $Monthend,
                'start_date' => Carbon::parse($min->attendance_time)->format('d') . ' ' . $MonthStart,
                'end_date_en' => Carbon::parse($max->attendance_time)->format('d') . ' ' . Carbon::parse($max->attendance_time)->format('M') . ' ' . Carbon::parse($max->attendance_time)->format('Y'),
                'start_date_en' => Carbon::parse($min->attendance_time)->format('d') . ' ' . Carbon::parse($min->attendance_time)->format('M'),
                'end_date_en_two' => Carbon::parse($max->attendance_time)->format('d/m/Y'),
                'bootstrap4' => $bootstrap4,
                'fontawesome' => $fontawesome,

                'user' => $user,
                'location' => $group->title,
                'teachers' => $teachers,
                'group' => $group,
                'course' => $course

            ];
            $Qr_name = 'Certificate-' . $course->id . '-' . $user->id . '-' . $certificate->type;

            if ($certificate->type == "ar") {
                if ($course->type_id == 3) { //حضوري
                    return  view('certificate.index-ar-direct', compact('certificate', 'data', 'Qr_name', 'direct', 'course'));
                } elseif ($course->type_id == 4) { //ملتقي
                    return  view('certificate.index-meeting', compact('certificate', 'data', 'Qr_name', 'direct', 'course'));
                } else {

                    return  view('certificate.index-ar', compact('certificate', 'data', 'Qr_name', 'direct', 'course'));
                }
            } else {
                if ($course->type_id == 3) { //حضوري
                    return  view('certificate.index-ar-direct', compact('certificate', 'data', 'Qr_name', 'direct', 'course'));
                }
                return  view('certificate.index-en', compact('certificate', 'data', 'Qr_name', 'direct', 'course'));
            }
        }
    }

    public function getMonthInArabic($date)
    {
        $months = array(
            "Jan" => "يناير",
            "Feb" => "فبراير",
            "Mar" => "مارس",
            "Apr" => "أبريل",
            "May" => "مايو",
            "Jun" => "يونيو",
            "Jul" => "يوليو",
            "Aug" => "أغسطس",
            "Sep" => "سبتمبر",
            "Oct" => "أكتوبر",
            "Nov" => "نوفمبر",
            "Dec" => "ديسمبر"
        );



        $en_month = date("M", strtotime($date));

        $ar_month = $months[$en_month];

        return $ar_month;
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
     * Get Verify Certificate form
     */
    public function getVerificationForm()
    {
        return view($this->path . '.certificate-verification');
    }

    /**
     * Verify Certificate
     */
    public function verifyCertificate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required',
        ]);

        $certificates = Certificate::where('name', '=', $request->name)
            ->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), "=", $request->date)
            ->get();
        $data['certificates'] = $certificates;
        $data['name'] = $request->name;
        $data['date'] = $request->date;
        session()->forget('certificates');
        return back()->with(['data' => $data]);
    }

    /**
     * Generate certificate for completed course
     */
    public function show($id, Request $request)
    {

        $certificateAr = Certificate::where('id', $id)->with(['user', 'course'])->first();
        // $clientQrCode = $this->createQrCode('https://drive.google.com/file/d/1yGxU77E8cK9Hbn70CZS2BQKtENz2Fx5-/view?usp=sharing');
        //dd($id,'dddd',$certificateAr);
        $course = Course::find($certificateAr->course_id);

        $QrAr_name = 'Certificate-' . $course->id . '-' . auth()->user()->id . '-ar';
        $location = CourseLocation::where(['user_id' => auth()->user()->id, 'course_id' => $course->id])->first();

        $data = [
            'name' => auth()->user()->name,
            'name_ar' => auth()->user()->name_ar,

            'course_name' => $course->title,
            'course_name_ar' => $course->title_ar,
            'date' => Carbon::now()->format('d M, Y'),

            'end_date' => Carbon::now()->format('d M, Y'),
            'start_date' => Carbon::parse($location->start_date)->format('d M, Y'),
            'user' => auth()->user(),
        ];

        return view('certificate.index-ar', compact('certificateAr', 'data', 'QrAr_name', 'course'));
    }

    public function GenerateSerial()
    {
        // $CertificateNUM = Certificate::count();
        // $sn = '';
        // $sn.=''.str_pad($CertificateNUM  + 1, 13, "202000", STR_PAD_LEFT);

        $allCert = Certificate::all();
        $count = count($allCert);
        $lastCertCount = $count == 0 ? 0 : $count;
        $exist = true;
        $SnCounter = 1;
        while ($exist) {
            if ($count > 0) {
                $SNExist = count(Certificate::where('SN', $allCert[$count - 1]->SN + $SnCounter)->get()) > 0;
                if ($SNExist)
                    $SnCounter += 1;
                else
                    $exist = false;
            } else {
                $exist = false;
            }
        }
        $sn = '';
        // $sn .= '' . str_pad($lastCertCount  + 1, 13, "2020002011000", STR_PAD_LEFT);
        $sn .= $count == 0 ? '' . str_pad($lastCertCount  + 1, 13, "2020002011000", STR_PAD_LEFT) : (int)$allCert[$count - 1]->SN + $SnCounter;

        // $chars = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        // $max = count($chars) - 1;
        // for ($i = 0; $i < 10; $i++) {
        //     //  $sn .= (!($i % 5) && $i ? '-' : '').$chars[rand(0, $max)];
        //     $sn .= (!($i % 5) && $i ? '' : '') . $chars[rand(0, $max)];
        // }
        // $sn .= '-' . ($CertificateNUM + 1);

        return $sn;
    }

    // Check if it exists, then re-generate

    public function checkifSerialexist($serial)
    {
        $CertificateNUM = Certificate::where('SN', $serial)->count();
        return ($CertificateNUM > 0);
    }

    public function success()
    {
        return view('frontend.courses.success');
    }

    public function showCourseUserCertificate($course_id, $student_id)
    {
        $user = User::find($student_id);
        $course = Course::find($course_id);
        $certificate = Certificate::where('user_id', $user->id)->where('course_id', $course->id)->first();
        if ($certificate == null) {
            return abort(404);
        }
        $html_url = $this->showCertificates($certificate->id, false)->render();

        $arabic = new Arabic();
        $p = $arabic->arIdentify($html_url);
        for ($i = count($p)-1; $i >= 0; $i-=2) {
            $utf8ar = $arabic->utf8Glyphs(substr($html_url, $p[$i-1], $p[$i] - $p[$i-1]));
            $html_url = substr_replace($html_url, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
        }


        $pdf = PDF::loadHTML($html_url);
        $pdf->setPaper('A4', 'landscape');
        //reduse the width of the pdf
        $pdf->setOptions(['isPhpEnabled' => true]);
        $pdf->setOptions(['isHtml5ParserEnabled' => true]);
        $pdf->setOptions(['isRemoteEnabled' => true]);

        return $pdf->stream($certificate->url);
    }

// get month in arabic


    /**
     * Generate certificate for completed course
     */
    public function generateTestDomCertificate()
    {
        $course = Course::where('id', '=', 81)->first();
        $serial = $this->GenerateSerial();
        while ($this->checkifSerialexist($serial)) {
            $serial = $this->GenerateSerial();
        }
        $certificate = Certificate::firstOrCreate([
            'user_id' => auth()->user()->id,
            'course_id' => 81,
            'type' => 'en',
            'SN' => $serial,
        ]);
        $location = CourseLocation::where(['user_id' => auth()->user()->id, 'course_id' => $course->id])->first();

        $data = [
            'name' => auth()->user()->name,
            'name_ar' => auth()->user()->name_ar,

            'course_name' => $course->title,
            'date' => Carbon::now()->format('d/m/Y'),
            // //////new data///
            'course_name_ar' => $certificate->course->title_ar,
            'end_date' => Carbon::now()->format('Y') . ' ' . Carbon::now()->format('M d'),
            'start_date' => Carbon::parse($location->start_date)->format('Y') . ' ' . Carbon::parse($location->start_date)->format('M d'),
            'user' => auth()->user(),
        ];

        $certificate_name = 'Certificate-' . $course->id . '-' . auth()->user()->id . '-en' . '.pdf';
        $Qr_name = 'Certificate-' . $course->id . '-' . auth()->user()->id . '-en';
        $certificate->name = auth()->user()->id;
        $certificate->url = $certificate_name;
        $certificate->save();
        // /////Arabic cerificate//////
        $serial = $this->GenerateSerial();
        while ($this->checkifSerialexist($serial)) {
            $serial = $this->GenerateSerial();
        }
        $certificateAr = Certificate::firstOrCreate([
            'user_id' => auth()->user()->id,
            'course_id' => 81,
            'type' => 'ar',
            'SN' => $serial,
        ]);

        $certificateAr_name = 'Certificate-' . $course->id . '-' . auth()->user()->id . '-ar' . '.pdf';
        $QrAr_name = 'Certificate-' . $course->id . '-' . auth()->user()->id . '-ar';
        $certificateAr->name = auth()->user()->id;
        $certificateAr->url = $certificateAr_name;
        $certificateAr->SN = $serial;
        $certificateAr->save();
        // ///////////////////////////generate qr///////////////
        Storage::disk('Qr')->put("qrCodes/" . $Qr_name . '.svg', DNS2D::getBarcodeSVG(asset('storage/certificates/' . $certificate_name), 'QRCODE'));
        Storage::disk('Qr')->put("qrCodes/" . $QrAr_name . '.svg', DNS2D::getBarcodeSVG(asset('storage/certificates/' . $certificateAr_name), 'QRCODE'));
        // /////////////////////////////Generate certificate PDF AR and EN///////////
        PDF::setOptions(['defaultFont' => 'cairo']);
        // $pdf = PDF::loadView('certificate.index-en', compact('data', 'certificate', 'Qr_name'))->setPaper('', 'landscape');
        // $pdf->save(public_path('storage/certificates/' . $certificate_name));
        $pdfArabic = PDF::loadView('certificate.index-test-ar', compact('data', 'certificateAr', 'QrAr_name'))->setPaper('', 'landscape');
        $pdfArabic->save(public_path('storage/certificates/' . $certificateAr_name));

        // ////


        return view('certificate.index-test-ar', compact('certificateAr', 'data', 'QrAr_name'));


        // return back()->withFlashSuccess(trans('alerts.frontend.course.completed'));

    }

    /**
     * Generate certificate for completed course
     */
    public function generateTestCertificate()
    {

        $course = Course::where('id', '=', 81)->first();
        $serial = $this->GenerateSerial();
        while ($this->checkifSerialexist($serial)) {
            $serial = $this->GenerateSerial();
        }
        $certificate = Certificate::firstOrCreate([
            'user_id' => auth()->user()->id,
            'course_id' => 81,
            'type' => 'en',
            'SN' => $serial,
        ]);
        $location = CourseLocation::where(['user_id' => auth()->user()->id, 'course_id' => $course->id])->first();

        $data = [
            'name' => auth()->user()->name,
            'name_ar' => auth()->user()->name_ar,

            'course_name' => $course->title,
            'date' => Carbon::now()->format('d/m/Y'),
            // //////new data///
            'course_name_ar' => $certificate->course->title_ar,
            'end_date' => Carbon::now()->format('Y') . ' ' . Carbon::now()->format('M d'),
            'start_date' => Carbon::parse($location->start_date)->format('Y') . ' ' . Carbon::parse($location->start_date)->format('M d'),
            'user' => auth()->user(),
        ];

        $certificate_name = 'Certificate-' . $course->id . '-' . auth()->user()->id . '-en' . '.pdf';
        $Qr_name = 'Certificate-' . $course->id . '-' . auth()->user()->id . '-en';
        $certificate->name = auth()->user()->id;
        $certificate->url = $certificate_name;
        $certificate->save();
        // /////Arabic cerificate//////
        $serial = $this->GenerateSerial();
        while ($this->checkifSerialexist($serial)) {
            $serial = $this->GenerateSerial();
        }
        $certificateAr = Certificate::firstOrCreate([
            'user_id' => auth()->user()->id,
            'course_id' => 81,
            'type' => 'ar',
            'SN' => $serial,
        ]);

        $certificateAr_name = 'Certificate-' . $course->id . '-' . auth()->user()->id . '-ar' . '.pdf';
        $QrAr_name = 'Certificate-' . $course->id . '-' . auth()->user()->id . '-ar';
        $certificateAr->name = auth()->user()->id;
        $certificateAr->url = $certificateAr_name;
        $certificateAr->SN = $serial;
        $certificateAr->save();
        // ///////////////////////////generate qr///////////////
        Storage::disk('Qr')->put("qrCodes/" . $Qr_name . '.svg', DNS2D::getBarcodeSVG(asset('storage/certificates/' . $certificate_name), 'QRCODE'));
        Storage::disk('Qr')->put("qrCodes/" . $QrAr_name . '.svg', DNS2D::getBarcodeSVG(asset('storage/certificates/' . $certificateAr_name), 'QRCODE'));
        // /////////////////////////////Generate certificate PDF AR and EN///////////


        $view = \View::make('certificate.index-test-ar', compact('data', 'certificateAr', 'QrAr_name'));
        // return $view;
        $html_content = $view->render();


        PDF::SetTitle('Sample PDF');
        PDF::SetFont('dejavusans');
        PDF::AddPage();
        PDF::writeHTML($html_content, true, false, true, 'UTF-8', '');

        PDF::Output(uniqid() . '_SamplePDF.pdf', 'D');
    }
    public function generateAllCertByAdmin(Request $request)
    {
        $group = CourseGroup::find($request->group_id);
        $count = 0;
       $groupStudents = $group->students;
        foreach ($groupStudents as $key => $student) {

            // Check if the student has a certificate for this group
            $hasCertificate = Certificate::where('user_id', $student->id)->where('group_id', $group->id)->first();

            if ($hasCertificate == null || $student->is_certified_by_admin == 0) {
                $count += 1;
                $this->generate_certificate_from_admin($request->group_id, $student->id);
                $student->is_certified_by_admin = 1;
                $student->save();
            }
        }
        return redirect()->back()->withFlashSuccess(__('alerts.backend.general.created_30' ). ' ' . $count);

        // generate_certificate_from_admin
        # code...
    }
}
