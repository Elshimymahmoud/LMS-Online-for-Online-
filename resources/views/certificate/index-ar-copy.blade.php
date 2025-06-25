<!DOCTYPE html>
<html lang="ar" id="element-to-print" style="font-size: 21px" >

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>مركز العاج الفضي</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">


    <style>
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
            margin-left: -50px;
            margin-bottom: 41px;

        }
        .cert-container{
           padding: 190px 115px;
        }
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
        p {
            margin-bottom: 0.5rem !important;
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
                <p>
                    يشهد العاج الفضي للتدريب أن
                </p>
                @if(request('for')=='test') {{$data['user']->gender}} @endif
                <p class=" fs-25" > 
                    <span class="title dark-red" @if(@$course->type_id==2 &&empty($certificate->course->accreditation_number))style="font-size:30px;" @endif>   {{ $data['user']->gender == 'female' ? 'السيدة ' : 'السيد ' }}  {{ $data['name_ar'] }} </span>
                </p>
                @if($data['user']->country=='السعودية')
                @if (!empty($data['user']->national_id_number) && !empty($data['user']->nationality))
                    <p class=" fs-unset fntCursive mb-0"> <span class="dark-red">
                        </span>   {{ $data['user']->gender == 'female' ? 'وجنسيتها' : 'وجنسيته' }}  {{ $data['user']->nationality }}  بموجب هوية رقم   {{ $data['user']->national_id_number }}
                           
                        {{-- </span>   ‫‪وجنسيته من {{$data['user']->country}}  بموجب هوية رقم   {{ $data['user']->national_id_number }} --}}
                    </p>
                @endif
                @endif
                <p >
                    قد  {{ $data['user']->gender == 'female' ? 'انجزت' : 'انجز' }}   متطلبات المشاركة في البرنامج التدريبي
                </p>


                <p class="sub-title dark-red fs-25" @if(@$course->type_id==2 &&empty($certificate->course->accreditation_number))style="font-size:30px;" @endif>
                    {{ @$data['course_name_ar'] }}
                </p>
                @if(@$course->type_id!=1 )
                <p>
                    و ذلك عبر قاعة العاج الفضي ‫الإلكترونية‬ عن بعد للفترة
                    ({{ $data['start_date'] }}-{{ $data['end_date'] }})
                    
                </p>
                @endif

                <p class="sub-title ">

                    {{-- لمدة ){{$certificate->course->hours_number}}( ساعة تدريبية --}}
                   و لمدة ( {{ @$certificate->course->courseDuration()['hours']}} ) 
                    @if(in_array(@$certificate->course->courseDuration()['hours'],[3,4,5,6,7,8,9,10]))

                    @lang('labels.frontend.course.hours')
                    @else
                    @lang('labels.frontend.course.hour')

                    @endif
                  تدريبية




                </p>

                @if (!empty($certificate->course->accreditation_number) && $data['user']->country=='السعودية')
                    <p >
                        و المعتمد من‫ ‫المؤسسة ‬العامة ‬ للتدريب التقني والمهني برقم/
                        {{ $certificate->course->accreditation_number }} </p>
                @endif
                @if($data['location']->name!='Online')

                @if($certificate->course->short_desc_in_certificate==1)
                <p class=" mt-50">
                    {{-- <span>وتم تغطية المحاور الأتية/{{$certificate->course->short_description_ar}}</span> --}}

                    {{ trim($certificate->course->short_description_ar) }}
                </p>
                @endif
                @endif
                @if(@$course->type_id!=2) {{-- type Online--}}
                <p style="font-size:15px">
                يصرح الطرف الثاني بأنه وحده قام بالتحضير والاعداد للحقيبة موضوع هذا العقد بدون التعرض لحقوق ملكية فكرية تخص طرف آخر، <br>
                وبأنه يضمن للطرف الأول بموجب هذا العقد عدم التعرض من الغير بهذا الخصوص
                </p>
                @endif
                <div class="qr" style="margin-top: 10px;font-size: 20px;">
                    <img src="{{ asset('storage/qrCodes/' . $Qr_name . '.svg') }}" alt="">

                    {{-- <img src="{{public_path('storage/qrCodes/testQr.svg')}}" alt=""> --}}
                    <p style="margin-bottom: 5px;
                    margin-top: 5px;">SN:{{ $certificate->SN }}</p>
                    <p style="margin-bottom:5px">Date:{{ $data['end_date_en_two'] }}</p>
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
