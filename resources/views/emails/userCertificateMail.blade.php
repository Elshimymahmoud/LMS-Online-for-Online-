@component('mail::message')
<p style="width: 100%; text-align:right !important ;">
 مرحبا بك من  شركة العاج الفضي للتدريب والاستشارات  
</p>

<p style="width: 100%;text-align:right !important ">

 تم اصدار شهادة لانجاز دورة {{$content['cert']->course->title_ar}}
<br>
</p>



<p style="width: 100%;text-align:right !important ">

    للذهاب الي الشهادة  اضغط علي الرابط التالي
   <br>
   </p>
<a style="border: none;margin-top:20px;display:block;text-align:center;background: #4f198d;padding: 10px;width: 50%;border-radius:10px;margin-left:253px !important;font-weight: bold;color:white" href="{{asset('storage/certificates/'.$content['cert']->url)}}">
شهادة {{$content['cert']->course->title_ar}}
</a>
<br>



<p style="text-align:right !important;">
    شكرا لك نتمني ان نراك قريبا
    </p>
<br>
<p style="text-align:right !important ">
{{ config('app.name') }}
</p>
@endcomponent

