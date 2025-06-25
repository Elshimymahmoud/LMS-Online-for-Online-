@component('mail::message')
    @if ($content['course_name'] == null)
<p style="width: 100%; text-align:right !important ;">
السيد/ة {{ $content['student']->name_ar?$content['student']->name_ar:$content['student']->first_name.' '.$content['student']->fourth_name }} المحترم / ة
</p>
<p style="width: 100%; text-align:right !important ;">
السلام عليكم تحية عطرة ،وبعد
</p>

<p style="text-align:right !important;">
بداية نشكر لكم ثقتكم باختيار تمهير للتدريب والاستشارات



</p>
<p style="text-align:right !important;">
مرفق لكم رابط فيديو توضيحي لطريقة استعمال منصة تمهير و متابعة البرنامج التدريبي  و ذلك على منصة تمهير
:التدريبية نرجوا منكم و نؤكد على مشاهدته أولا 
<br>
<a href=" https://jwp.io/s/gKWxR9Hw">https://jwp.io/s/gKWxR9Hw</a>
</p>
<p style="text-align:right !important;">
: و من ثم الدخول إلى المنصة عبر الضغط على الرابط التالي
<br>
<a href=" http://e-training.ivorytraining.com/">http://e-training.ivorytraining.com/</a>
</p>

@if ($content['password'] != null)
<p style="text-align:right !important;">
بعدها الدخول إلى حسابكم على منصة تمهير التدريبية حسب اسم المستخدم و كلمة السر التاليين
</p>
<p style="text-align:right !important;">
{{ $content['email'] }}:بريد الكتروني
</p>
<p style="text-align:right !important;">
<span style="color:darkblue">{{ $content['password'] }}</span>:رقم سري
</p>
@endif



<p style="text-align:right !important;">
<a href="https://twitter.com/ivorytraining">https://twitter.com/ivorytraining</a> :حسابنا على تويتر
<br>
<a href="https://www.facebook.com/ivorytraining/">https://www.facebook.com/ivorytraining/</a> : حسابنا على فيس
بوك
<br>

<a href="https://www.instagram.com/ivorytraining/">https://www.instagram.com/ivorytraining/</a> : حسابنا على
انستغرام
<br>

<a href="https://t.me/ivorytrainig:">https://t.me/ivorytrainig:</a> قناتنا على التليغرام
<br>

شاكرين ومقدرين تعاونكم وتفهمكم.
<br>

للتواصل المباشر مع الدعم الفني عبر الواتساب
<br>
<a href="https://wa.me/message/KXHDE3ZAYCOZC1">https://wa.me/message/KXHDE3ZAYCOZC1</a>


</p>


<p style="text-align:right !important;">
.ايفوري وسع نجاحك
</p>
<br>
<p style="text-align:right !important ">
{{ config('app.name') }}
</p>
{{-- ====================================== --}}

    @else
        {{-- =========New course participation --}}
<p style="width: 100%; text-align:right !important ;">
            مرحبا بكم في شركة العاج الفضي للتدريب والاستشارات
</p>

<p style="width:100%;text-align:right !important;">
تم اشتراكك في دورة ({{ $content['course_name'] }})
</p>
@if($content['start_date'])
<p style="width:100%;text-align:right !important;">
    تاريخ البدء: {{ $content['start_date'] }}

</p>
@endif
@if($content['end_date'])

<p style="width:100%;text-align:right !important;">
    تاريخ الانتهاء: {{ $content['end_date'] }}

</p>
@endif

<p style="text-align:right !important;">
     {{ $content['student']->email }} :البريد الكتروني
</p>
@if ($content['password'] != null)
<p style="text-align:right !important;">
    {{ $content['password'] }} :كلمة المرور
</p>
@endif
@if($content['course_slug'])
<p style="text-align:right !important;">
لتصفح الدورة اضغط على الرابط التالي
<br>
<a style="border: none;margin-top:20px;display:block;text-align:center;background: #4f198d;padding: 10px;
 width: 50%;
border-radius:10px;
margin-left:253px !important;
font-weight: bold;color:white" href="{{ route('courses.show', ['course' => $content['course_slug']]) }}">
{{ $content['course_name'] }}
</a>
</p>
@endif
<p style="text-align:right !important;">

@if(isset($content['courseLocation']))
@php
$CourseLocDays=App\Models\CourseLocDays::where( 'course_location_id',$content['courseLocation']->id)->get(); 
@endphp
@if(count($CourseLocDays)>0)
علما ان البرنامج سيكون أيام 
@endif
@foreach ($CourseLocDays as $key=>$courseLocDay)
{{ $courseLocDay->name_ar }} 
@if ($key<count($CourseLocDays)-1)
و
@endif

@endforeach
<br>
من الساعة {{$content['courseLocation']->from_time}} الي الساعة {{$content['courseLocation']->to_time}}

بتوقيت مكة المكرمة حسب جدوال التوقيت التالي
<br>
<a href="{{$content['courseLocation']->time_links}}">{{$content['courseLocation']->time_links}}</a>
</p>

@endif
<p style="text-align:right !important;">
:تعليمات حضور البرنامج التدريبي
<ul style="direction: rtl;text-align:right">
<li>
لاستحقاق الشهادة يجب حضور 85 بالمئة من البرنامج التدريبي و تقديم 85 بالمئة من التاسكات التي سيتم طلبها .
</li>
<li>
نرجو منكم الدخول إلى الزوم بالاسم الصحيح وذلك لتسجيل الحضور علما أنه سيتم التواصل مع السادة المشاركين الذين
يدخلون بأسماء غير صحيحة و الطلب منهم إما إعادة التسمية أو ارسال الاسم الصحيح و في حال عدم الرد سيتم إخراج
المشارك من المنصة إلى حين تزويدنا بالاسم الصحيح
</li>
<li>
يجب الدخول للمنصة قبل بدء البرنامج بخمس دقائق على الأقل كي لا يفوتكم شيء وكي لا يحصل تأخير في البدء بالجلسة

</li>
<li>
 في حال لم يتم دفع كامل رسوم البرنامج التدريبي فيجب إكمال الدفعة
المتبقية من الأجور بعد الجلسة الثانية وقبل
بدء الجلسة الثالثة
</li>
<li>
لا يحق للمشارك استرجاع رسوم البرنامج في حال انسحب او اعتذر عن اكمال البرنامج التدريبي بعد البدء بالبرنامج.
التدريبي
</li>
</ul>
<br>
</p>

<p style="width: 100%;text-align:right !important ">

شاكرين ومقدرين تعاونكم وتفهمكم.
<br>
نحن بخدمتكم بحال وجود أي استفسار لا تترددوا في الاتصال بنا
</p>
<p style="width: 100%;text-align:right !important ">
{{-- @foreach ($content['teachers'] as $teacher)
{{ $teacher->name_ar }}:منسق البرنامج
<br>
{{ $teacher->phone ? 'رقم الجوال:' . $teacher->phone : '' }}
<br>
 {{ $teacher->email }}:ايميل 
<br>
@endforeach --}}
@if(isset($content['courseLocation']))

@php
$CourseLoccoordinators=App\Models\CourseLocCoordinator::where( 'course_location_id',$content['courseLocation']->id)->get(); 

@endphp
@foreach ($CourseLoccoordinators as $CourseLoccoordinator)
{{$CourseLoccoordinator->coordinator->gender=='female'?'منسقة':'منسق'}} البرنامج:{{ $CourseLoccoordinator->coordinator->name_ar }} 
<br>
رقم الجوال:{{$CourseLoccoordinator->coordinator->phone}}
<br>
 {{$CourseLoccoordinator->coordinator->email}} :البريد الاليكتروني
<br>
@endforeach
<br>


</p>
@endif


<p style="width: 100%;text-align:right !important ">

وفي حال عدم الوصول للمنسق يمكن التواصل مع
<br>
:مدير البرامج التدريبية 
<br>
رياض الحاج حسن
<br>
رقم الجوال :966533993122+
<br>
tr_coordinator@ivorytraining.com :  ايميل
</p>

<p style="text-align:right !important;">
.ايفوري وسع نجاحك
</p>
<br>
<p style="text-align:right !important ">
{{ config('app.name') }}
</p>
        {{-- =========New course participation --}}
    @endif
@endcomponent
