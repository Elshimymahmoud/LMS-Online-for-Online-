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
p{
    line-height: unset;
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
padding: 226px 110px;
}
.title{
font-weight: bold;
font-size: 24px;
}

.sub-title{
font-weight: bold;
font-size: 18px;
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
style="background-image:url({{ asset('images/cert-meet.jpg') }});background-size:cover;background-repeat:no-repeat">




<div class="container-fluid px-0 " style="height: 500px">
<div class="cert-container">


<div class="col-12">
<p>


تشهد تمهير للتدريب والاستشارات أن
</p>

<p class=" fs-25"> 
{{ $data['user']->gender == 'female' ? 'السيدة ' : 'السيد ' }}   <span class="title dark-red" style="font-size:28px "> {{ $data['name_ar'] }} </span> .
</p>

<p >
قد  {{ $data['user']->gender == 'female' ? 'حضرت ' : 'حضر ' }}    الملتقى التدريبي
</p>

<p class="sub-title dark-red" style="font-size: 28px;margin-bottom: 0px;">
{{ @$data['course_name_ar'] }}
</p>
 <p>
والذي أقيم في
{{$data['location']->name_ar}}

{{-- @if($data['location']->name!='Online') --}}
<br>
بتاريخ
{{ $data['start_date'] }}-{{ $data['end_date'] }}
  (ولمدة {{ @$data['course']->courseDurationByCourseLocationId($data['courseLocId'])['hours']}} @if(in_array(@$certificate->course->courseDuration()['hours'],[3,4,5,6,7,8,9,10]))

  @lang('labels.frontend.course.hours')
  @else
  @lang('labels.frontend.course.hour')
  
  @endif
  تدريبية ) 


</p>
{{-- @endif --}}

<p style="font-size:15px">
يصرح الطرف الثاني بأنه وحده قام بالتحضير والاعداد للحقيبة موضوع هذا العقد بدون التعرض لحقوق ملكية فكرية تخص طرف آخر، <br>
وبأنه يضمن للطرف الأول بموجب هذا العقد عدم التعرض من الغير بهذا الخصوص
</p>



<div class="qr" style="display:inline;margin-top: 90px">
<img src="{{ asset('storage/qrCodes/' . $Qr_name . '.svg') }}" alt="">

{{-- <img src="{{public_path('storage/qrCodes/testQr.svg')}}" alt=""> --}}
<p style="margin-bottom:unset;font-weight: bold;
margin-top: 5px;font-size:12px">SN:{{ $certificate->SN }}</p>
<p style="margin-bottom:5px;font-size:13px;font-weight: bold;">Date:{{ $data['end_date_en_two'] }}</p>
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
