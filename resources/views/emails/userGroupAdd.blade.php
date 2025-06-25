@component('mail::message')
<p style="width: 100%; text-align:right !important ;">
مرحبا بك من  شركة العاج الفضي للتدريب والاستشارات
</p>
@if($content['group_name']!=null)
<p style="width: 100%;text-align:right !important ">

 تم اشتراكك في المجموعه {{$content['group_name']}}
<br>
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
    font-weight: bold;color:white" href="{{route('courses.show',['course'=>$content['course_slug'],
    'group'=>$content['group_id'] ])}}">
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

