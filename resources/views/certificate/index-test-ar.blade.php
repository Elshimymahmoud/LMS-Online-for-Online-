<!DOCTYPE html>
<html lang="ar">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



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

</head>

<body>
  


   
    <div class="container-fluid px-0 " style="height: 500px;background-image: url('{{asset('images/certificate-ar.JPG')}}')" >
        <div style="position: relative;text-align:right" class=" row h-100 position-relative m-0">


            <div class="col-12 text-block">
                <p class="fntCursive fs-unset mb-0 mr-1">


                    يشهد العاج الفضي للتدريب أن
                </p>

                <p class=" fs-25  mb-0 mr-4" > <span
                        class="dark-red">{{$data['name_ar']}} </span> السيد.
                </p>
                @if(!empty($data['user']->national_id_number))
                  <p class=" fs-unset fntCursive mr-2 mb-0"> <span class="dark-red"> {{$data['user']->national_id_number}}
                      </span> ‫‪وجنسيته سعودي بموجب هوية رقم
                  </p>
                @endif

                <p >
                  قد أنجز متطلبات المشاركة
              </p>

              <p >
                قد أنجز متطلبات المشاركة في البرنامج التدريبي
            </p>


                <p>
                    {{@$data['course_name_ar']}}
                </p>
                <p class="desc course-title fntCursive fs-unset  mb-0"
                   
                >
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
                   
                >
                    {{-- <span>وتم تغطية المحاور الأتية/{{$certificateAr->course->short_description_ar}}</span> --}}

                    {{trim($certificateAr->course->short_description_ar)}}
                </p>

                <div class="qr">
                    <img src="{{asset('storage/qrCodes/'.$QrAr_name.'.svg')}}" alt="">

                    {{-- <img src="{{public_path('storage/qrCodes/testQr.svg')}}" alt=""> --}}
                    <p>SN:{{$certificateAr->SN}}</p>
                    <p>Date:{{$data['date']}}</p>
                </div>
            </div>
            {{-- {{public_path('images/certificate-ar.JPG')}} --}}
            {{-- <img width="1000px" src="{{public_path('images/certificate-ar.JPG')}}"> --}}
        </div>
    </div>
</body>

</html>