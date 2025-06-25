<!DOCTYPE html>
<html dir="rtl" lang="ar">
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
            url({{public_path('/fonts/GESS/ge-ss-two-bold/ge-ss-two-bold.ttf')}}) format('truetype'),
            @import url(https://fonts.googleapis.com/earlyaccess/amiri.css);
        @import url(https://fonts.googleapis.com/earlyaccess/droidarabickufi.css);
        @import url(https://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css);
        @import url(https://fonts.googleapis.com/earlyaccess/lateef.css); 
        @import url(https://fonts.googleapis.com/earlyaccess/scheherazade.css);
        @import url(https://fonts.googleapis.com/earlyaccess/thabit.css);
        }
        @font-face {
            font-family: 'GESS';
            src:url({{public_path('/fonts/GESS/ge-ss-two-bold/ge-ss-two-bold.ttf')}}) format('truetype'),
           url({{public_path('/fonts/GESS/GE-SS-Two-Bold.otf')}}) format('truetype'),

        }
     
       
        body, h1, h2, h3, h4, span, div {
            /*font-family: 'Dancing Script', cursive;*/
            /* font-family: 'Lobster Two', cursive; */
            font-family: 'Droid Arabic Naskh', serif;


        }
        * { font-family: DejaVu Sans, sans-serif !important;
            line-height: 1 !important;
            direction: rtl !important;
        }
        
        /* * { font-family: 'Cairo','Mirza' ,sans-serif,'DejaVu Sans' !important;
            line-height: 1 !important;
        } */
       
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
            text-align: right;
        }

        .text-block p {
            line-height: 1;
            margin-top: 20px;
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
            margin-top: -20px;
            margin-right: 75%;
                }
                .qrLeft{
                
            margin-left: 75%;
                }
                .qrLeft p{
            margin-top: 2px !important;
                }
                .qrLeft img{
                    width: 100px;
                    height: 100px;;
                }
                .qr img{
                    width: 100px;
                    height: 100px;;
                }
                .qr p{
                    margin: 0;
                   margin-top: 6px;
                }
                .desc{
                            width: 80%;
                            direction:rtl;
                            text-align:start;
                            margin-left: 20%;
                            text-align-last: right;
                            line-height: 2 !important;
                }
                .ml-90{
                    margin-left: 90px;
                }
                .mr-90{
                    margin-right: 90px;
                }
                .fntCursive{
                    font-family:'cursive'
                }
              
        
    </style>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid px-0 " style="height: 500px">
    <div style="position: relative;text-align:right"
         class=" row h-100 justify-content-center text-center position-relative m-0">
    

        <div  class="col-12 text-block align-self-center">
            <p style="margin-right: 3px" class="text-right fs-unset fntCursive mr-90">يشهد العاج الفضي للتدريب أن  
            </p>
            <p  class="text-right fs-30 mr-90 mb-0" style="margin-right: 3px">  <span class="font-weight-bold dark-red" style="font-family: DejaVu Sans;">{{$data['name_ar']}} </span> السيد  
            </p>
            <p  class="text-right fs-unset fntCursive mr-90 mb-0" style="margin-right: 3px" > <span class="font-weight-bold dark-red" style="font-family: DejaVu Sans;">{{$data['user']->national_id_number}}</span>‫‪وجنسيته سعودي بموجب هوية رقم 
            </p>
            
                <p class="text-right mr-90 mb-0" style="position: relative; right:-87px;" >
                    <span>قد أنجز متطلبات المشاركة في البرنامج التدريبي  </span>
                </p>
            
           
            <p style="word-wrap: break-word;white-space: nowrap" class="text-right fs-23 mr-90 mb-0"><span class="font-weight-bold dark-red" style="font-family: DejaVu Sans;     direction: ltr !important;">{{@$data['course_name_ar']}}</span>
            </p>
           
            <p  class="text-right fntCursive fs-unset mr-90 mb-0" style="margin-right: -20px">
                <span class="fntCursive" >{{$data['start_date']}}-{{$data['end_date']}}</span>

                 وذلك عبر قاعة العاج الفضي ‫اإللكترونية‬ عن بعد للفترة
          
                 </p>
                 <p class="text-right fntCursive fs-unset mr-90 mb-0">
                  
                    <span class="font-weight-bold"> لمدة  ){{$certificateAr->course->hours_number}}( ساعة تدريبية</span>
                   
                    </p>
                

                    <p  class="text-right fntCursive fs-unset mr-90 mb-0" style="margin-right: 2px">

                     والمعتمدة من‫ ‫المؤسسة‬العامة‬  للتدريب التقني والمهني برقم/
                     {{$certificateAr->course->accreditation_number}} </p>
      
                 <p class="desc text-right fntCursive fs-unset mr-90 mb-0"  style="font-family: 'Times New Roman', Times, serif;margin-right: 2px;">
                    {{-- <span>وتم تغطية المحاور الأتية/{{$certificateAr->course->short_description_ar}}</span> --}}
     
                    {{trim($certificateAr->course->short_description_ar)}}
                </p>
       
                    <div class="qr">
            <img src="{{public_path('storage/qrCodes/').$QrAr_name.'.svg'}}" alt="">

            {{-- <img src="{{public_path('storage/qrCodes/testQr.svg')}}" alt=""> --}}
    <p >SN:{{$certificateAr->SN}}</p>
    <p >Date:{{$data['date']}}</p>
            </div>
    </div>
   
        <img width="100%" src="{{public_path('images/certificate-ar.JPG')}}">
    </div>
</div>
</body>
</html>