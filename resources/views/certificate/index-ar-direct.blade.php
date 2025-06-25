<!DOCTYPE html>
<html lang="ar" id="element-to-print" style="font-size: 21px">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>مركز العاج الفضي</title>
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">--}}
{{--    <link rel="preconnect" href="https://fonts.googleapis.com">--}}
{{--    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap"--}}
{{--          rel="stylesheet" media="print">--}}

    <style> {{ $data['bootstrap4'] }} </style>
    <style> {{ $data['fontawesome'] }} </style>

    <style>
        body{
            padding-right: 50px;
        }

        .head-title {
            text-align: start;
            /* font-size: 13px; */
            /* font-weight: 700; */
            /*padding: -2px;*/
            /*margin-top: -242px;*/
            /*white-space: nowrap;*/
            /*!* line-height: 2px; *!*/
            /*padding: 60px;*/
        }

        body,
        h1,
        h2,
        h3,
        h4,
        span,
        div {
            /*font-family: 'Dancing Script', cursive;*/
            /* font-family: 'Lobster Two', cursive; */
            font-family: 'Cairo', sans-serif;
            direction: rtl
        }

        * {
            /* font-family: 'IBM Plex Sans Arabic', sans-serif !important; */
            font-family: 'Cairo', sans-serif;
        }



        body {
            margin: 0px;
            color: #37231a;
            /* direction: rtl !important; */
            text-align: justify;
            justify-content: right;


        }

        .dark-red {
            color: #7d2b32;
        }

        .main-border {
            border: 20px solid darkred;
        }

        /*p {*/
        /*    line-height: normal;*/
        /*}*/

        .row {
            position: relative;
        }

        .qr {
            margin-top: -50px;
            display: inline-block;
            width: 300px;
            position: relative;
            text-align: center;
            float: right;
            margin-right: 10px !important;
            margin-bottom: 15px;
            padding-bottom: 62px;

        }

        .cert-container {
            padding: 250px 150px;
            /* margin-top: 44px; */
            margin-top: 3px;


            padding-right: 65px;
        }

        .title {
            font-weight: bold;
            font-size: 24px;
        }

        .sub-title {
            font-weight: bold;
            font-size: 20px;
        }

        .mt-50 {
            margin-top: 50px
        }

        .cert-type {
            text-align: center;
            font-size: 42px;
            color: #7d2b32;
            margin-bottom: 0px;

            padding-top: 40px;
            margin-bottom: -80px !important;       
        }

        .cert-type-col {
            margin-top: -34px;
        }

        /*.content-cert p {*/
        /*    font-size: 18px;*/
        /*    margin-right: 32px;*/
        /*    margin-bottom: -3px;*/
        /*}*/

        /*.content-cert-en {*/
        /*    text-align: left;*/
        /*    font-size: 18px;*/
        /*    margin-top: 10px;*/
        /*    margin-right: -318px;*/
        /*}*/

        /*.content-cert-en p {*/
        /*    font-size: 18px;*/
        /*    margin-right: 52px;*/
        /*    margin-bottom: -3px;*/
        /*}*/


 
        body {
            width: 297mm !important;
            height: 210mm !important;
            size: landscape !important;
            margin: 0mm !important;

        }

        .cert-container {
            padding-right: 0px !important;
            padding-bottom: 0px !important;

        }

        .content-cert {
            margin-top: 111px !important;


        }

        /*.content-cert p {*/
        /*    font-size: 18px !important;*/
        /*}*/

        .qr {
            margin-top: -40px !important;
            margin-right: 200px !important;
            padding-bottom: 0px !important;

        }

        .head-title {
            text-align: start;
            /* font-size: 11px  !important ; */
            /* font-weight: 700; */
            /*padding: -2px;*/
            /*!* margin-top: -242px  !important ; *!*/
            /*margin-top: -281px !important;*/
            /*white-space: nowrap;*/
            /*!* line-height: 2px; *!*/
            /*padding: 60px 40px 60px;*/
        }

        .cert-type-col {
            margin-top: -67px !important;
        }

        .cert-type {
            text-align: center;
            font-size: 46px !important;
            color: #7d2b32;
            margin-bottom: 0px;
        }

        /*.content-cert-en {*/
        /*    text-align: left;*/
        /*    font-size: 18px !important;*/
        /*    margin-top: 10px !important;*/
        /*    margin-right: -145px !important;*/
        /*}*/

        .training_manager {
            text-align: left;
            /* margin-right: -140px !important ; */
        }

        .title {
            /* font-size: 20px; */
            font-size: 20px !important;
        }


    </style>
    <style>
        body {
            width: 100%!important;
            height: 100%!important;
        }
        * {
            /* font-family: 'IBM Plex Sans Arabic', sans-serif !important; */
            font-family: 'Cairo', sans-serif;
        }
        p{
            page-break-inside: avoid;
            /*padding-bottom: 8px;*/
            font-size: 14px!important;
            padding:0!important;
            margin:0!important;
        }
    </style>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body id='body' style="background-image:url({{ asset('images/dierct-cert-ar.jpg') }});background-size:cover;background-repeat:no-repeat" >

    <div class="container-fluid px-0 " style="padding-right: 0 !important;">
        <div class="cert-container" style="margin-top: -242px;">

            <div class="col-lg-3 head-title" style="padding-top: 54px">
                 <p style="margin-bottom: 2px;font-size:12px !important;font-weight:bold; padding-bottom: 0px!important;">   المملكة العربية السعودية</p>
                <p style="margin-bottom: 2px;font-size:12px !important;font-weight:bold; padding-bottom: 0px!important;">مركز العاج الفضي للتدريب</p>
                <p style="margin-bottom: 2px;font-size:12px !important;font-weight:bold; padding-bottom: 0px!important;">تحت اشراف المؤسسة العامة للتدريب التقني والمهني</p>
                <p style="margin-bottom: 2px;font-size:12px !important;font-weight:bold; padding-bottom: 0px!important;">رخصة رقم (224158385151812)</p>
            </div>
            <div class="col-lg-12 cert-type-col">
                <p class="cert-type">شهادة حضور دورة تطويرية</p>
            </div>
            <div class="col-12" style="float: right; text-align: right; line-height: 14px;margin-top:60px">
                <p>
                    يشهد مركز العاج الفضي للتدريب أن
                </p>
                <p>
                    <span class="title dark-red"> {{ $data['name_ar'] }} </span>
                </p>
                <p>
                    قد {{ $data['user']->gender == 'female' ? 'أنجزت' : 'أنجز' }} متطلبات المشاركة في البرنامج التدريبي
                </p>
                <p class="fs-25">
                    <span class="title dark-red"> {{ @$data['course_name_ar'] }} </span>
                </p>

                <p class=" fs-25">
                    وذلك في {{ $data['group']->title_ar }} , {{ $data['group']->groupPlaces->name_ar }}

                </p>

                <p class=" ">
                    بتاريخ
                    {{ $data['start_date'] }}-{{ $data['end_date'] }}
                    {{-- لمدة ){{$certificate->course->hours_number}}( ساعة تدريبية --}}
                    (ولمدة {{ @$data['course']->courseDuration()['hours'] }}
                    @if (in_array(@$data['course']->courseDuration()['hours'], [3,
                    4, 5, 6, 7, 8, 9, 10]))
                        @lang('labels.frontend.course.hours')
                    @else
                        @lang('labels.frontend.course.hour')
                    @endif
                    تدريبية
                    )



                </p>


            </div>
            <div class="col-12" style="float: left; text-align: left; direction: ltr;  line-height: 14px;
            margin-top:140px;margin-left:130px;">
                <p>


                    IVORY Training & Consulting Certifies That
                </p>

                <p class=" fs-25">
                    <span class="title dark-red"> {{ $data['name'] }} </span>
                </p>


                <p>
                    Has Participated In The Training Program
                </p>


                <p class="fs-25">
                    <span class="title dark-red"> {{ @$data['course_name'] }}</span>
                </p>

                <p>
                    in {{ $data['group']->title }} , {{ $data['group']->groupPlaces->name }} , on
                    {{ $data['start_date_en'] }} - {{ $data['end_date_en'] }}

                </p>


                <p>

                    {{-- لمدة ){{$certificate->course->hours_number}}( ساعة تدريبية --}}
                    and fulfilled the requirements of ( {{ $data['course']->courseGroupDuration
                    ($data['group']->id)['hours'] }} )
                    actual training Hours


                </p>

                <div class="training_manager">
                    <br>
                    <p style="font-size: 18px"><span style="font-weight: bolder"> Training Manager: </span>Eng. Bader
                        Alahmary
                    </p>
                    <p style="margin-top:0!important;display: inline-block;text-align: right">
                        <img style="width: 90px;margin-top:12px;margin-left:120px" src="{{ asset('iv/images/signature.png') }}"
                             alt="">
                    </p>
                    <div class="qr" style="margin-top: -73px!important;text-align: start!important;">
                        <img style="width: 90px;" src="{{ asset('storage/qrCodes/' . $Qr_name
                     . '.svg') }}"
                             alt="">


                        <p style="font-size:12px;font-weight: bold;">
                            Date:{{ $data['end_date_en_two'] }}</p>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <div id="editor"></div>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>

{{--    <script>--}}
{{--        var direct = '{{ $direct }}';--}}

{{--        if (direct == 'true')--}}
{{--            window.print();--}}
{{--    </script>--}}

</body>

</html>
