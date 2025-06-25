
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    @php
        if($type=="website"){
            $base64Image = base64_encode(file_get_contents(public_path($model_image)));
        }else{
            if($image){
                $base64Image = base64_encode(file_get_contents(public_path('/storage/uploads/certificate_templates/'
                .$image)));
            }else{
                $base64Image = base64_encode(file_get_contents(public_path('assets/bg-white.png')));
            }
        }
        $qrCodee64Image = base64_encode(file_get_contents(public_path('/storage/qrCodes/'.$qr_code)));

        $qr_height = $qr_height??300;
        $qr_width = $qr_width??300;
    @endphp
    <style>
        @import url('http://fonts.googleapis.com/css2?family=Amiri&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Oswald&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Jozoor&display=swap');
        @import url('http://fonts.googleapis.com/earlyaccess/thabit.css');
        @import url('http://fonts.googleapis.com/earlyaccess/droidarabickufi.css');
        @import url('http://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css');
        @import url('http://fonts.googleapis.com/css2?family=Lateef');
        @import url('http://fonts.googleapis.com/css2?family=Scheherazade');
        @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Tajawal&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Rakkas&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Aref+Ruqaa&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=El+Messiri&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic&display=swap');
    </style>
    <style>
        @font-face {
            font-family: 'Noto Kufi Arabic';
            src: url('{{ public_path('assets/fonts/Noto_Kufi_Arabic/NotoKufiArabic-VariableFont_wght.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'Amiri';
            src: url('assets/fonts/Amiri-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Amiri';
            src: url('assets/fonts/Amiri-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: 'Tajawal';
            src: url('assets/fonts/Tajawal-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: 'Rakkas';
            src: url('assets/fonts/Rakkas-Regular.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: 'El Messiri';
            src: url('assets/fonts/ElMessiri-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: 'droidarabickufi';
            src: url('assets/fonts/Droid-Arabic-Kufi-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'droidarabickufi';
            src: url('assets/fonts/Droid-Arabic-Kufi-Regular.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }
        @font-face {
            font-family: 'droidarabicnaskh';
            src: url('assets/fonts/Droid-Arabic-Naskh-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'droidarabicnaskh';
            src: url('assets/fonts/Droid-Arabic-Naskh-Regular.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: 'Jozoor';
            src: url('assets/fonts/Jozoor-Font-Regular.otf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Jozoor';
            src: url('assets/fonts/alfont_com_Jozoor-Font.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }
        body{

            margin: 0;
            padding: 0;
            direction: rtl;
            font-family: 'Cairo', sans-serif;
            overflow: hidden; /* Add this line */
        }

        @page { margin: 0px; }
        body { margin: 0px; }
        html { margin: 0px}
        .page {
            margin: 0px;
            padding: 0px;
            background-image: url('data:image/jpeg;base64,{{ $base64Image }}');
            background-size:cover;
            background-repeat: no-repeat;
            /* width: 100%; */
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .qrcode {
            height: {{ $qr_height }}px;
            width: {{ $qr_width }}px;
        }

        /*.page-break {*/
        /*    page-break-after: always;*/
        /*}*/

    </style>
</head>
<body dir="rtl">
    <div class="page">
        @php

            $gender = 'السيد/ة';
            $realize = 'أنجز/ت';
            if($cert->gender=="دكر"){
                $gender = 'السيد';
                $realize = 'أنجز';
            }else if($cert->gender =="انثى"){
                $gender = 'السيدة';
                $realize = 'أنجزت';
            }

            $issued_date = $cert->created_at;
            if(!is_string($cert->created_at)){
                $issued_date = $cert->created_at->format('Y-m-d');
            }
            $start_date = $group->start;
            if(!is_string($group->start)){
                $start_date = $group->start->format('Y-m-d');
            }
            $end_date = $group->end;
            if(!is_string($group->end)){
                $end_date = $group->end->format('Y-m-d');
            }

            $qrCode='<img class="qrcode" src="data:image/png;base64,'.$qrCodee64Image.'">';


            if($type=="website"){
                $sourceCode=$code;
            }else{
                $sourceCode=$code_print;
            }

            $course = $cert->course->title;
            $pattern = '/[\x{0600}-\x{06FF}\x{0750}-\x{077F}]+/u';
            if( preg_match($pattern, $course) === 1){
                $course = preg_replace('/[^\p{Arabic}]/u', ' ', $course);
            }

            $sourceCode = str_replace([
                                        '{name}', '{name_ar}','{course}','{qr_code}',
                                        '{issued_date}','{start_date}','{end_date}',
                                        '{national_id}', '{course_name_ar}', '{course_name}',
                                        '{accreditation_number}','{hours}', '{certificate_number}',
                                        '{id_cert}', '{group_name}', '{group_name_ar}','{location_ar}','{location}'

                                        ],
                                        [
                                            $cert->user->full_name??'-', $cert->user->full_name_ar,$course??'-',$qrCode??'-',

                                            $issued_date??'-',$start_date??'-',$end_date??'-',
                                            $cert->user->national_id??'-', $cert->course->title_ar??'-', $cert->course->title??'-',
                                            $cert->accreditation_number??'-',$cert->hours??'-',$cert->id??'-',

                                            $cert->id??'-', $group->title_en??'-', $group->title_ar??'-', $group->groupPlaces->name_ar??'-',
                                            $group->groupPlaces->name??'-'


                                        ]

                                        , $sourceCode
                                    );
        @endphp

        <div style="max-height:100vh !important; overflow:hidden" class="ctn">
            {!! $sourceCode !!}

{{--            @if ( $loop->index < count($list_participant)-1)--}}
{{--                <div class="page-break"></div>--}}
{{--            @endif--}}

        </div>
        </div>


</body>
</html>
