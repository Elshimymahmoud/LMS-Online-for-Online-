
@component('mail::message')
#Hello from Ivory Training {{auth()->user()->name}}

{{auth()->user()->name}} want to invite you to see course {{$content['course_name']}}:<br>

To join course press link
<a style="border: none;
background: #4f198d;    padding: 10px;
    width: 50%;
    border-radius:10px;
    font-weight: bold;color:white" href="{{route('courses.show',['course'=>$content['course_slug']])}}">
    {{$content['course_name']}}
</a>
<br>
Happy Shopping.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
