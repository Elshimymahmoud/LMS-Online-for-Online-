@component('mail::message')
<p style="width: 100%">
مرحبا بك من  شركة العاج الفضي للتدريب والاستشارات
</p>
<p style="width: 100%">
بناءا علي الشكوي بعنوان  ({{$content['complain_title']}})
قامت خدمة العملاء  بالرد كالتالي
<br>
</p>

<br>
<p>
    ({{$content['reply']}})
</p>

<br>
<p> للتواصل سريعا عن طريق واتس اب رقم +966115209894</p>
شكرا لك نتمني ان نراك قريبا<br>
{{ config('app.name') }}
@endcomponent

