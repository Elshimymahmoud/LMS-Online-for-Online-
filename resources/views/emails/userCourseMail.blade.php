@component('mail::message')
<p style="width: 100%; text-align:right !important ;">
مرحبا بك من  شركة العاج الفضي للتدريب والاستشارات
</p>
@if($content['course_name']!=null)
<p style="width: 100%;text-align:right !important ">

 تم اشتراكك في دورة {{$content['course_name']}}
<br>
</p>
@endif
<p style="text-align:right !important;">وتم اضافة حساب  لك </p>
<br>
<p style="text-align:right !important;">
{{$content['email']}}:بريد الكتروني 
</p>
@if($content['password']!=null)


<p style="text-align:right !important;">
    <span style="color:darkblue">{{$content['password']}}</span>:رقم سري
    </p>
    @endif
@if($content['course_slug']!=null)

<p style="width: 100%;text-align:right !important ">

    لتصفح الدورة اضغط علي الرابط التالي
   <br>
   </p>
<a style="border: none;margin-top:20px;
display:block;
text-align:center;
background: #4f198d;padding: 10px;
    width: 50%;
    border-radius:10px;
    margin-left:253px !important;
    font-weight: bold;color:white" href="{{route('courses.show',['course'=>$content['course_slug']])}}">
    {{$content['course_name']}}
</a>
<br>
@endif


<p style="text-align:right !important;">
    شكرا لك نتمني ان نراك قريبا
    </p>
<br>
<p style="text-align:right !important ">
{{ config('app.name') }}
</p>
@endcomponent

