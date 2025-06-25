<!DOCTYPE html>
<html style="font-size: 21px">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  

    <title>Neon LMS : Certificate of Completion</title>

    {{--<link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster+Two:400,700" rel="stylesheet">



    <style>
        @font-face {
            font-family: 'Lobster Two';
            src: url({{public_path('/fonts/lobster/LobsterTwo-Bold.ttf')}}) format('truetype'),
            url({{public_path('/fonts/lobster/LobsterTwo-BoldItalic.ttf')}}) format('truetype'),
            url({{public_path('/fonts/lobster/LobsterTwo-Italic.ttf')}}) format('truetype'),
            url({{public_path('/fonts/lobster/LobsterTwo-Regular.ttf')}}) format('truetype'),

            @import url(https://fonts.googleapis.com/earlyaccess/amiri.css);
            @import url(https://fonts.googleapis.com/earlyaccess/droidarabickufi.css);
            @import url(https://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css);
            @import url(https://fonts.googleapis.com/earlyaccess/lateef.css); 
            @import url(https://fonts.googleapis.com/earlyaccess/scheherazade.css);
            @import url(https://fonts.googleapis.com/earlyaccess/thabit.css);
            }

               
        * { font-family: DejaVu Sans, sans-serif !important;
        }
 
        body, h1, h2, h3, h4, span, div {
            /*font-family: 'Dancing Script', cursive;*/
            /* font-family: 'Lobster Two', cursive; */
            font-family: 'Droid Arabic Naskh', serif;

        }

        body {
            margin: 0px;
            color: #37231a;
        }

        .main-border {
            border: 20px solid darkred;
        }

        .row {
            position: relative;
        }
      
        p{
            line-height: normal;
        }
        /*.main-border .row{*/
        /*height: 800px;*/
        /*}*/
        .main-border .row h1 {
            font-size: 80px;
        }

        .banner {
            position: absolute;
            left: 0;
            right: 0;
            margin: auto;
        }

        .badge-img {
            right: 0;
            top: 0;
        }

        .logo {
            left: 40%;
            position: absolute;
            bottom: 22%;
            right: 0;
            display: inline-block;
            margin: auto;
        }

        /*.container-fluid {*/
        /*width: 1200px;*/
        /*height: 855px;*/
        /*}*/

        .wrapper {
            position: absolute;
            left: 0;
            top: 50%;
            right: 0;
            margin: auto;
        }

        .text-block {
            position: absolute;
            right: 0;
            margin: auto;
            top: 20%;
            left: 0;
            text-align: left;
        }

        .text-block p {
            line-height: 1;
            margin-top: 27px;
            /* font-size: 30px; */
            opacity: 0.9;
        }

        .font-weight-bold {
            font-weight: bolder;
        }
        .rtl .mr-135{
            margin-right: 135px;
        }
        .rtl .text-right{
            direction: rtl;
            text-align: right;
        }
        .fs-unset{
            font-size: unset;
        }
        .fs-23{
            font-size: 23px;
        }
        .fs-30{
            font-size: 30px;
        }
        .dark-red{
            color: #7e2833;
        }
        .qr{
            margin-top: 10%;
            margin-right: 75%;
                }
                .qrLeft{
                
            /* margin-left: 75%; */
            margin-left: 82%;
                }
                .qrLeft p{
            /* margin-top: 2px !important; */
                }
                .qrLeft img{
                    width: 100px;
                    height: 100px;;
                }
                .qr p{
                    margin: 0;
            margin-top: 6px;
                }
                .desc{
                    width: 70%;
            text-align: right;
        
            margin-left: 22%;
            line-height: 2 !important;
                }
                .ml-90{
                    margin-left: 90px;
                }
                .fntCursive{
                    font-family:'cursive'
                }
    </style>

<style>
  body { font-family: DejaVu Sans, sans-serif; }
  
</style>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body
    style="background-image:url({{ asset('images/certificate-en.JPG') }});background-size:cover;background-repeat:no-repeat">

<div class="container-fluid px-0 " style="height: 500px">
    <div style="position: relative;text-align: center"
         class=" row h-100 justify-content-center text-center position-relative m-0">
      

        <div  class="col-12 text-block align-self-center">
            <p  class="text-left fs-unset fntCursive ml-90  mb-0" style="margin-top:98px">Silver Ivory  for Training Certifies that 
            </p>
            <p  class="text-left fs-30 fntCursive ml-90 mb-0">Mr.  <span class="font-weight-bold dark-red" style="font-family: DejaVu Sans;">{{$data['name']}}</span>
            </p>
            @if($data['user']->country=='السعودية')
            @if(!empty($data['user']->national_id_number) && !empty($data['user']->nationality))

            <p  class="text-left fs-unset fntCursive ml-90 mb-0">And His Nationality {{$data['user']->nationality}}  by the residence number/ <span class="font-weight-bold dark-red" style="font-family: DejaVu Sans;">{{$data['user']->national_id_number}}</span>
            </p>
            @endif
            @endif

            <p  class="text-left fntCursive fs-unset ml-90 mb-0">
                has participated in the Training Program
            </p>
            ‬
            <p style="word-wrap: break-word;white-space: nowrap" class="text-left fs-30 ml-90 mb-0"><span class="font-weight-bold dark-red" style="font-family: DejaVu Sans;     direction: rtl !important;">{{@$data['course_name']}}</span>
            </p>
           
            {{-- @if($data['location']->name!='Online') --}}
                 <p  class="text-left fntCursive fs-unset ml-90  mb-0" style="word-wrap: break-word;white-space: nowrap;"> Through Silver Ivory online platform During the period <span class="font-weight-bold fntCursive" >{{$data['start_date_en']}}-{{$data['end_date_en']}}</span>
                
                 </p>
                 {{-- @endif --}}
            
                
                 <p class="text-left fntCursive fs-unset ml-90  mb-0"><span class="font-weight-bold fntCursive"> And fulfilled the requirements of  ( {{ @$certificate->course->courseDuration()['hours']}} ) 
                    @if(in_array(@$certificate->course->courseDuration()['hours'],[3,4,5,6,7,8,9,10]))

                    @lang('labels.frontend.course.hours')
                    @else
                    @lang('labels.frontend.course.hour')

                    @endif
                  <b>actual Training hours </b></span> </p>
                 @if(!empty($certificate->course->accreditation_number)&& $data['user']->country=='السعودية')<p class="    text-left fntCursive fs-unset ml-90  mb-0" >approved by TVTC No.{{$certificate->course->accreditation_number}}  </p>@endif

        <div class="qrLeft" style="margin-top: 30px">
           
             <img src="{{ asset('storage/qrCodes/' . $Qr_name . '.svg') }}" alt="">

            {{-- <img src="{{public_path('storage/qrCodes/testQr.svg')}}" alt=""> --}}
                <p style="margin-bottom: 5px;margin-left: -47px;">SN:{{$certificate->SN}}</p>
                <p style="margin-bottom: 5px;margin-left: -47px;">Date:{{$data['end_date_en']}}</p>
            </div>
    </div>
   
    </div>
</div>
</body>
</html>