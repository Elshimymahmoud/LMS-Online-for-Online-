@component('mail::message')
<p style="width: 100%">
مرحبا بك من  شركة العاج الفضي للتدريب والاستشارات
</p>
<p style="width: 100%">
قام صديقك {{auth()->user()->name}}
بدعوتك للانضمام لدورة {{$content['course_name']}}
<br>
</p>
للانضمام للدورة اضغط علي الرابط
<br>
<a style="border: none;margin-top:20px;
display:block;
text-align:center;
background: #4f198d;    padding: 10px;
    width: 50%;
    border-radius:10px;
    font-weight: bold;color:white" href="{{route('courses.show',['course'=>$content['course_slug']])}}">
    {{$content['course_name']}}
</a>
<br>

شكرا لك نتمني ان نراك قريبا<br>
{{ config('app.name') }}
@endcomponent

