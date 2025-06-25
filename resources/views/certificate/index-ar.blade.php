<!DOCTYPE html>
<html lang="ar" id="element-to-print" style="font-size: 21px">

<head>
    <meta content="text/html" charset="utf-8">

    <title>مركز العاج الفضي</title>
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" media="print">--}}
{{--    <link rel="preconnect" href="https://fonts.googleapis.com">--}}
{{--    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet" media="print">--}}

    <style> {{ $data['bootstrap4'] }} </style>
    <style> {{ $data['fontawesome'] }} </style>
    <style>
        body {
            width: 100%!important;
            height: 100%!important;
            overflow: hidden!important;
        }
        p {
            page-break-inside: avoid;
            padding-right: 45px;
            text-align: right;
        }
    </style>
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        span,
        div {
            font-family: 'Dancing Script', cursive;
             font-family: 'Lobster Two', cursive;
            font-family: 'Cairo', sans-serif;
            direction: rtl;

        }
        body{
            width: 1203px;
            height: 854px;;
        }
        * {
            /* font-family: 'IBM Plex Sans Arabic', sans-serif !important; */
            font-family: 'Cairo', sans-serif;
        }

        m-0 {
            margin: 0px !important;
        }

        body {
            margin: 0px;
            color: #37231a;
            /* direction: rtl !important; */
            text-align: justify;
            justify-content: right;


        }
        .dark-red{
            color: #7d2b32;
        }
        .main-border {
            border: 20px solid darkred;
        }
        p{
            line-height: normal;
        }

        .row {
            position: relative;
        }
        .qr{
            display: inline-block;
            width: 300px;
            text-align: center;
            float: left;
            /*margin-left: -50px;*/
            /*margin-bottom: 41px;*/

        }
        /*.cert-container{*/
        /*   padding: 190px 115px;*/
        /*}*/
        .title{
            font-weight: bold;
            font-size: 24px;
        }

        .sub-title{
            font-weight: bold;
            font-size: 20px;
        }
        .mt-50{
            margin-top: 50px
        }


    </style>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body
    style="background-image:url({{ asset('images/certificate-ar.JPG') }});background-size:cover;background-repeat:no-repeat">




    <div class="container-fluid px-0 " style="height: 500px">

        <div class="cert-container" @if(@$course->type_id==1 )style="margin-top:100px;font-size:30px;" @elseif(@$course->type_id==2 ) style="margin-top:70px" @endif>


            <div class="col-12">
                <p style="margin-top: 3rem; margin-bottom: 0">
                    يشهد العاج الفضي للتدريب أن
                </p>
                @if(request('for')=='test') {{$data['user']->gender}} @endif
                <p class=" fs-25" style="margin: 0; margin-top: -1rem;">
                    <span class="title dark-red" @if(@$course->type_id==2 &&empty($certificate->course->accreditation_number))style="font-size:30px;" @endif>   {{ $data['user']->gender == 'female' ? 'السيدة ' : 'السيد ' }}  {{ $data['name_ar'] }} </span>
                </p>

                <p class="m-0" style="margin: -4rem 0 0;">
                    قد  {{ $data['user']->gender == 'female' ? 'انجزت' : 'انجز' }}   متطلبات المشاركة في البرنامج التدريبي
                </p>


                <p class="sub-title dark-red fs-25 m-0" @if(@$course->type_id==2 &&empty($certificate->course->accreditation_number))style="font-size:30px;" @endif>
                    {{ @$data['course_name_ar'] }}
                </p>
                @if($course->type_id != 1 )
                    <p>
                        <span> ({{ $data['start_date'] }} - {{ $data['end_date'] }})</span>
                        <span> للفترة</span>
                        <span>وذلك عبر قاعة العاج الفضي الإلكترونية عن بعد</span>
                    </p>
                    <p class="sub-title" >
                        تدريبية
                        @if(in_array(@$data['course']->courseGroupDuration($data['group'])['hours'],[3,4,5,6,7,8,9,10]))

                            @lang('labels.frontend.course.hours')
                        @else
                            @lang('labels.frontend.course.hour')

                        @endif

                        {{-- لمدة ){{$certificate->course->hours_number}}( ساعة تدريبية --}}
                        و لمدة ({{$certificate->course->id==6? @$data['course']->courseGroupDuration($data['group'])['hours']+2:@$data['course']->courseGroupDuration($data['group'])['hours']}})

                    </p>
                @else
                    <p>
                        <span>و ذلك عبر قاعة مركز تمهير الإلكترونية</span>
                    </p>
                @endif

                @if($course->type_id == 1)

                    @if($certificate->course->short_desc_in_certificate==1)
                        <p class="m-0">
                            {{-- <span>وتم تغطية المحاور الأتية/{{$certificate->course->short_description_ar}}</span> --}}

                            {{ trim($certificate->course->short_description_ar) }}
                        </p>
                    @endif
                @endif
                @if(@$course->type_id!=2) {{-- type Online--}}
                    <p style="font-size:15px; padding:0; margin: -1rem 40px 0 0; text-align: right; float: right" >
                        <span> فكرية تخص طرف</span>
                        <span>للحقيبة موضوع هذا العقد بدون التعرض لحقوق ملكية</span>
                        <span>يصرح الطرف الثاني بأنه وحده قام بالتحضير والاعداد </span>
                        <br>
                        <span>التعرض من الغير بهذا الخصوص</span>
                        <span>آخر، وبأنه يضمن للطرف الأول بموجب هذا العقد عدم </span>
                    </p>
                @endif
                <div class="qr" style="font-size: 20px; margin-top: 2rem;">
                    <img src="{{ asset('storage/qrCodes/' . $Qr_name . '.svg') }}" alt="">
                    <p style="margin:0;margin-top: -1.5rem;margin-right: 25px;">Date:{{ $data['end_date_en_two'] }}</p>
                </div>
            </div>

        </div>
    </div>
    {{-- <script src="{{asset('js/html2pdf.min.js')}}"></script>
    <script>
        var element = document.getElementById('element-to-print');
html2pdf(element);

    </script> --}}
</body>

</html>
