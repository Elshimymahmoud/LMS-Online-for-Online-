<!DOCTYPE html>
<html lang="ar" id="element-to-print">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Neon LMS : Certificate of Completion</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster+Two:400,700" rel="stylesheet">


    <style>

        @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@600;700&display=swap');

        body,
        h1,
        h2,
        h3,
        h4,
        span,
        div {
            /*font-family: 'Dancing Script', cursive;*/
            /* font-family: 'Lobster Two', cursive; */
            font-family: 'Droid Arabic Naskh', serif;

        }

        * {
            /* font-family: 'IBM Plex Sans Arabic', sans-serif !important; */
            font-family: 'IBM Plex Sans Arabic', sans-serif !important;
        }



        body {
            margin: 0px;
            color: #37231a;
            /* direction: rtl !important; */
            text-align: justify;
            justify-content: right;


        }

        .main-border {
            border: 20px solid darkred;
        }

        .row {
            position: relative;
        }




        .text-block {
            position: absolute;
            right: 0;
            margin: auto;
            top: 20%;
            left: 0;
            /* text-align: right; */
        }

        .text-block p {
            /* line-height: 1; */
            margin-top: 15px;
            opacity: 1;
        }



        .fs-23 {
            font-size: 23px;
        }

        .fs-30 {
            font-size: 30px;
        }

        .fs-25 {
            font-size: 25px;
        }

        .dark-red {
            color: #7e2833;
        }

        .qr {
            margin-top: -15px;
            margin-right: 80%;
        }

        .qrLeft {

            margin-left: 75%;
        }

        .qrLeft p {
            margin-top: 2px !important;
        }

        .qrLeft img {
            width: 100px;
            height: 100px;
            ;
        }

        .qr img {
            width: 100px;
            height: 100px;
            margin-left: 10px;
        }

        .qr p {
            margin: 0;
            margin-top: 6px;
            margin-right: -10px;
            text-align: right;
            direction: ltr;

        }


        .desc {
            width: 80%;
            direction: rtl;
            text-align: right;
            margin-left: 25%;
            text-align-last: right;
            line-height: 1 !important;

        }

        .height-2 {
            line-height: 2 !important;


        }

        .course-title {
            margin-left: 27%; /
            
        }

        .course-number {
            margin-left: 26%
        }

        .description {
            margin-left: 31%;
            /* width: 60px; */
            text-align: center;


            text-align-last: center;




        }
        }

        .mr-4 {
            margin-right: 4px;
        }

        /*     
span{
    margin-left: 25%;
}
p{
    margin-left: 25%;
} */
    </style>
    @if(strlen(@$data['course_name_ar'])<=0)
    <style>
        .course-title1{
            margin-left: 27% ;
        

        }
    </style>
    @else
    <style>
        .course-title1{
        margin-left: 14% !important;
     
    }
    </style>
    
    @endif
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
  


   
    <div class="container-fluid px-0 " style="height: 500px">
        <div style="position: relative;text-align:right" class=" row h-100 position-relative m-0">


            <div class="col-12 text-block">
                <p class="fntCursive fs-unset mb-0 mr-1">


                    يشهد العاج الفضي للتدريب أن
                </p>

                <p class=" fs-25  mb-0 mr-4" style="font-family:cairo !important"> <span
                        class="dark-red">{{$data['name_ar']}} </span> السيد.
                </p>
@if(!empty($data['user']->national_id_number))
                <p class=" fs-unset fntCursive mr-2 mb-0"> <span class="dark-red"> {{$data['user']->national_id_number}}
                    </span> ‫‪وجنسيته سعودي بموجب هوية رقم
                </p>
@endif

                <p class="desc fntCursive fs-unset mb-0" style="font-family: 'Times New Roman', Times, serif">

                    قد أنجز متطلبات المشاركة في البرنامج التدريبي
                </p>


                <p style="font-family: 'Times New Roman', Times, serif"
                    class="desc course-title course-title1 fntCursive fs-30 mb-0 dark-red">
                    {{@$data['course_name_ar']}}
                </p>
                <p class="desc course-title fntCursive fs-unset  mb-0"
                    style="font-family: 'Times New Roman', Times, serif;">
                    وذلك عبر قاعة العاج الفضي ‫اإللكترونية‬ عن بعد للفترة
                    ){{$data['start_date']}}-{{$data['end_date']}}(
                </p>


                <p class="mr-3">

                    {{-- لمدة ){{$certificateAr->course->hours_number}}( ساعة تدريبية --}}
                    لمدة ){{$certificateAr->course->chapters->sum('session_length')}}( ساعة تدريبية
                    
                   


                </p>

                @if(!empty($certificateAr->course->accreditation_number))
                <p class="desc course-number">

                    والمعتمدة من‫ ‫المؤسسة‬العامة‬ للتدريب التقني والمهني برقم/
                    {{$certificateAr->course->accreditation_number}} </p>@endif

                <p class="desc height-2 description fntCursive fs-unset  mb-0"
                    style="font-family: 'Times New Roman', Times, serif;">
                    {{-- <span>وتم تغطية المحاور الأتية/{{$certificateAr->course->short_description_ar}}</span> --}}

                    {{trim($certificateAr->course->short_description_ar)}}
                </p>

                <div class="qr">
                    <img src="{{public_path('storage/qrCodes/').$QrAr_name.'.svg'}}" alt="">

                    {{-- <img src="{{public_path('storage/qrCodes/testQr.svg')}}" alt=""> --}}
                    <p>SN:{{$certificateAr->SN}}</p>
                    <p>Date:{{$data['date']}}</p>
                </div>
            </div>

            <img width="100%" src="{{asset('images/certificate-ar.JPG')}}">
        </div>
    </div>
    <script src="{{asset('js/html2pdf.min.js')}}"></script>
    <script>
        var element = document.getElementById('element-to-print');
// var pdf=html2pdf(element);
var worker = html2pdf().from(element).outputPdf().save()
console.log(worker);
// console.log(pdf['file_name']);
$url='<?php echo asset("storage");?>';
// console.log($url);
// $worker->Output($url+'/file_xxxx.pdf', 'F');
    </script>
</body>

</html>