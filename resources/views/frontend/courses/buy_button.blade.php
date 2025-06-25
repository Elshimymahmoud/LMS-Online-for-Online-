@push('after-styles')
    <style>
        .modal-backdrop {
            z-index: 19 !important;
        }

        #locationModal {
            top: 25%;
        }

        #locationTable {
            color: black;
            font-size: 16px;
        }

        #locationTable th {
            text-align: center;
        }

        #locationModalLabel {
            color: #4f198d;
        }

        .modal-header .close {
            margin-top: -30px;
        }

        .modal-header {

            border-bottom: none;
        }

    </style>
@endpush
@if (!$purchased_course)

    {{-- @if(auth()->check() && (auth()->user()->hasRole('student')) && (Cart::session(auth()->user()->id)->get( $course->id)))
        <button class="show-login"   style="margin-left: 0" type="submit">
            <span>@lang('labels.frontend.layouts.course.get_course')</span>
            <div class="price"> @if($course->free == 1)  {{trans('labels.backend.courses.fields.free')}}  @endif </div>
        </button> --}}
    @if(!auth()->check())
        {{-- <a href="/login?course={{$course->slug}}" class="show-login share openpop btn btn-primary btn-get-course" data-value="model" style="margin-left: 0;width: 70%;
        font-size: 20px; 
        border: 1px solid white;
        background-color: #eeebebf5;
        font-weight: bold;
        color: #4f198d;
        border-radius: 13px;
        padding:16px;
        margin-top: 21px;"
        > --}}
        @if(count($groups) > 0)
            @if($group->end < \Carbon\Carbon::now() && $course->type_id!=1)
                <a href="#" disabled class="show-login share openpop btn btn-primary btn-get-course"
                   style="margin-left: 0;width: 70%;
    font-size: 20px;
    border: 1px solid white;
    background-color: #eeebebf5;
    font-weight: bold;
    color: #4f198d;
    border-radius: 13px;
    padding:16px;
    margin-top: 5px;
    opacity:1"
                   type="button" class="btn btn-primary">
                    @lang('labels.frontend.course.course_finish')
                </a>
            @else
                <a href="#courseLocContent" onclick="showmsg()"
                   class="show-login share openpop btn btn-primary btn-get-course" data-value="model" style="margin-left: 0;width: 70%;
                font-size: 20px;
                border: 1px solid white;
                background-color: #eeebebf5;
                font-weight: bold;
                color: #4f198d;
                border-radius: 13px;
                padding:16px;
                margin-top: 5px;"
                   type="button" class="btn btn-primary" data-toggle="modal" data-target="#locationModal"
                >
                    <span>@lang('labels.frontend.layouts.course.get_course')</span>
                    {{-- <div class="price"> @if($course->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.$course->price}} @endif </div> --}}
                </a>
            @endif

        @else
            <a href="/login?course={{$course->slug}}" class="show-login share openpop btn
    btn-primary btn-get-course" data-value="model"
               style="margin-left: 0;width: 70%;
    font-size: 20px; 
    border: 1px solid white;
    background-color: #eeebebf5;
    font-weight: bold;
    color: #4f198d;
    border-radius: 13px;
    padding:16px;
    margin-top: 5px;"
               type="button" class="btn btn-primary"
            >
                <span>@lang('labels.frontend.layouts.course.get_course')</span>
                {{-- <div class="price"> @if($course->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.$course->price}} @endif </div> --}}
            </a>

        @endif
    @elseif(auth()->check() && (auth()->user()->hasRole('student')))
        @if(count($groups)>0)
            @if($group->end < \Carbon\Carbon::now() && $course->type_id!=1)
                <a href="#" disabled class="show-login share openpop btn btn-primary btn-get-course"
                   style="margin-left: 0;width: 70%;
    font-size: 20px;
    border: 1px solid white;
    background-color: #eeebebf5;
    font-weight: bold;
    color: #4f198d;
    border-radius: 13px;
    padding:16px;
    margin-top: 5px;
    opacity:1"
                   type="button" class="btn btn-primary">
                    @lang('labels.frontend.course.course_finish')
                </a>
            @elseif($course->free == 1)
                <form action="{{ route('cart.getnow') }}" method="POST" class="show-login"
                      style="padding:0;margin-left: 0">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}"/>
                    <input type="hidden" name="amount" value="{{($course->free == 1) ? 0 : $course->price}}"/>
                    <button class="show-login btn share openpop btn-primary btn-get-course" type="submit"
                            style="margin-left: 0;
                font-size: 20px;
                border: 1px solid white;
                background-color: #eeebebf5;
                font-weight: bold;
                color: #4f198d;
                border-radius: 13px;
                padding:16px;
                margin-top: 5px;
                ">
                        <span>@lang('labels.frontend.layouts.course.get_course')</span>
                        <div class="price"> @if($course->free == 1)
                                {{trans('labels.backend.courses.fields.free')}}
                            @endif </div>
                    </button>
                </form>
            @else

                <form action="{{ route('cart.checkout') }}" method="POST" class="show-login"
                      style="padding:0;margin-left: 0">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}"/>
                    <input type="hidden" name="amount" value="{{($course->free == 1) ? 0 : $course->price}}"/>

                    {{-- <button class="show-login"  type="submit" style="width: 70%;border:none">
                        <span>@lang('labels.frontend.layouts.course.get_course')</span>
                        <div class="price"> @if($course->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.$course->price}} @endif </div>
                    </button> --}}

                    <a class="show-login btn share openpop btn-primary btn-get-course"
                       style="margin-left: 0;
                font-size: 20px;
                border: 1px solid white;
                background-color: #eeebebf5;
                font-weight: bold;
                color: #4f198d;
                border-radius: 13px;
                padding:16px;
                margin-top: 5px;
                " href="#courseLocContent" aria-expanded="true" aria-controls="collapseExample" class="show-login"
                       type="button" style="width: 70%;border:none">
                        <span>@lang('labels.frontend.layouts.course.get_course')</span>
                        {{-- <div class="price"> @if($course->free == 1)  {{trans('labels.backend.courses.fields.free')}} @else {{$appCurrency['symbol'].' '.@$course->price}} @endif </div> --}}
                        <div class="price"> @if($course->free == 1)
                                {{trans('labels.backend.courses.fields.free')}}
                            @else   @endif </div>

                    </a>

                </form>

            @endif
        @endif

    @else
        @if(@$continue_course)

            {{-- <a  href="{{route('lessons.show',['id' => $course->id,'slug'=>$continue_course->model->slug])}}" class="show-login dark-red-bg btn btn-primary btn-get-course " style="margin-left: 0;padding: 25px;margin-top:11px;font-weight:bold;"  data-value="model">
                @lang('labels.frontend.course.continue_course')
            </a> --}}
            <a style="margin-left: 0;width: 70%;
        font-size: 20px;
        border: 1px solid white;
        background-color: #eeebebf5;
        font-weight: bold;
        color: #4f198d;
        border-radius: 13px;
        padding:16px;
        margin-top: 5px;" sans-serif; href="#courseLocContent"
               class="show-login dark-red-bg btn btn-primary btn-get-course "
               style="margin-left: 0;padding: 25px;margin-top:11px;font-weight:bold;" data-value="model">
                @lang('labels.frontend.course.continue_course')
            </a>
        @endif
    @endif

@else

    @if(@$continue_course)

        {{-- <a   href="{{route('lessons.show',['id' => $course->id,'slug'=>$continue_course->model->slug])}}" class="show-login dark-red-bg btn btn-primary btn-get-course " style="margin-left: 0;padding: 25px;margin-top:11px;font-weight:bold;"  data-value="model">
            @lang('labels.frontend.course.continue_course')
        </a> --}}
        <a style="margin-left: 0;width: 70%;
        font-size: 20px; 
        border: 1px solid white;
        background-color: #eeebebf5;
        font-weight: bold;
        color: #4f198d;
        border-radius: 13px;
        padding:16px;
        margin-top: 5px;" href="#courseLocContent" onclick="showmsg()"
           class="show-login dark-red-bg btn btn-primary btn-get-course "
           style="margin-left: 0;padding: 25px;margin-top:11px;font-weight:bold;" data-value="model">
            @lang('labels.frontend.course.continue_course')
        </a>
    @endif

@endif
<!-- Modal -->
<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="locationModalLabel">{{trans('labels.backend.locations.choose')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <table class="table table-striped table-hover" id="locationTable">
                    <tbody>
                    <thead>
                    <th>المكان</th>
                    <th>التاريخ</th>
                    <th>السعر</th>
                    <th>انضم الان</th>
                    </thead>
                    @foreach ($groups as $location)
                        <tr>
                            <td>
                                {{session('locale') == 'ar'? $location->title_ar:$location->title_en }}
                            </td>
                            @if($course->type_id!=2)
                                <td>
                                    {{ $location->start }}
                                </td>

                            @else

                                <td></td>
                            @endif
                            <td>
                                {{ $location->price }}
                                @if($location->currency=='SAR')
                                    {{ $appCurrency['symbol'] }}

                                @else
                                    $
                                @endif
                            </td>
                            <td>
                                @include('frontend.courses.buy_button2')
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">اغلاق</button>

            </div>
        </div>
    </div>
</div>

@push('after-scripts')
    {{-- <script>
        function goToCourseLocation(){
            window.location="#CourseLocation";
            document.getElementById('CourseLocation').classList.add('zoom-in-out-box');
           setTimeout(() => {
            document.getElementById('CourseLocation').classList.remove('zoom-in-out-box');

           }, 1000);

    }
    </script> --}}
    <script>
        function showmsg() {
            $('#chooseMsg').show();
            setTimeout(() => {
                $('#chooseMsg').hide();
            }, 3000);
        }
    </script>

@endpush