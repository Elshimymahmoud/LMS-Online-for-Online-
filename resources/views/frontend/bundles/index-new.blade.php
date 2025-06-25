@extends('frontend.layouts.app'.config('theme_layout'))
@section('title', trans('labels.frontend.course.courses') . ' | ' . app_name())

@push('after-styles')

@endpush
@section('content')

    <section class="row the-slider" id="slider">
        <div class="course_banner" style="background: url({{asset('iv')}}/images/courses-bg.png);background-size: contain;background-repeat: no-repeat;min-height:500px;background-color: #fdfaf1;">
            <div class="container">
                <div class="row benefit-notes">
                    <!--==========Single Benefit==========-->
                    <div class="col-sm-8 col-md-8 benefit wow fadeInUp slider-content">
                        <h3 class="title text-color">تصفح كل الدورات</h3>
                        <div>
                            <form action="">
                                <div class="row  mt-50">
                                    <div class="col-md-6">
                                        <input name="key" type="text" value="{{request()->key}}" placeholder="@lang('labels.frontend.home.search_course_placeholder')" class="fw100 form-control large-input rounded-50 " />
                                    </div>
                                    <div class="col-md-6" >
                                        <select name="type" type="text" placeholder="@lang('labels.frontend.home.search_course_placeholder')" class="fw100 form-control large-input rounded-50 mtb-10" style="margin-top: 0">
                                            <option value=""> @lang('labels.frontend.home.all_types') </option>
                                            @foreach($coursesTypes as $key => $courses_type)
                                                <option @if(request()->type==$key) selected @endif value="{{$key}}">{{$courses_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <select name="location" type="text" placeholder="@lang('labels.frontend.home.search_course_placeholder')" class="fw100 form-control large-input rounded-50 mtb-10" style="-webkit-appearance: none;padding-top:0;">
                                            <option value=""> @lang('labels.frontend.home.all_cities') </option>
                                            @foreach($locations as $key => $location)
                                                <option @if(request()->location==$key) selected @endif  value="{{$key}}">{{$location}}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="col-md-4" style="padding-left: 0;padding-right: 0">
                                        <select name="dates" type="text" placeholder="@lang('labels.frontend.home.search_course_placeholder')" class="fw100 form-control large-input rounded-50 mtb-10" style="-webkit-appearance: none;padding-top:0;">
                                            <option value=""> @lang('labels.frontend.home.all_dates')  </option>
                                            <option @if(request()->dates=="1 week") selected @endif value="1 week"> @lang('labels.frontend.home.week')   </option>
                                            <option @if(request()->dates=="1 month") selected @endif  value="1 month"> @lang('labels.frontend.home.one_months')   </option>
                                            <option @if(request()->dates=="2 months") selected @endif value="2 months"> @lang('labels.frontend.home.2_months') </option>
                                            <option @if(request()->dates=="3 months") selected @endif value="3 months"> @lang('labels.frontend.home.3_months') </option>
                                            <option @if(request()->dates=="4 months") selected @endif value="4 months">@lang('labels.frontend.home.4_months')</option>
                                            <option @if(request()->dates=="5 months") selected @endif  value="5 months">@lang('labels.frontend.home.5_months')</option>
                                            <option @if(request()->dates=="6 months") selected @endif value="6 months">@lang('labels.frontend.home.6_months')</option>
                                            <option @if(request()->dates=="7 months") selected @endif value="7 months">@lang('labels.frontend.home.7_months')</option>
                                            <option @if(request()->dates=="8 months") selected @endif value="8 months">@lang('labels.frontend.home.8_months')</option>
                                            <option @if(request()->dates=="9 months") selected @endif value="9 months">@lang('labels.frontend.home.9_months')</option>
                                            <option @if(request()->dates=="10 months") selected @endif value="10 months">@lang('labels.frontend.home.10_months')</option>
                                            <option @if(request()->dates=="11 months") selected @endif value="11 months">@lang('labels.frontend.home.11_months')</option>
                                            <option @if(request()->dates=="1 year") selected @endif  value="1 year">@lang('labels.frontend.home.year')</option>
                                        </select>                                   
                                    </div>
                                    <div class="col-md-4">
                                        <button  type="text" placeholder="@lang('labels.frontend.home.search_course_placeholder')" class="fw100  large-input  rounded-50 mtb-10  btn-primary btn-lg " > @lang('labels.frontend.home.search_course') </button>                                
                                    </div>
                                </div>
                            </form>
                        </div>

                        <span class="inline-block course-categories" style="margin-top: 50px">
                            @foreach($categories as $category)
                                <a href="{{route('bundles.category',['category'=>$category->slug,'key'=>request('key'),'type'=>request('type'),'location'=>request('location'),'dates'=>request('dates')])}}" class=" btn btn-default ">
                                    @if(session('locale') == 'ar') {{ $category->name_ar }} @else {{$category->name}}  @endif
                                </a>
                            @endforeach
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==========The Benefits==========-->
    <section class="row the-bendefits" id="dfeatures" style="margin-bottom: 20px;margin-top: 50px">
        <div class="container">
            <div class="row section-header wow fadeInUp">
                <h2>@lang('labels.frontend.course.courses')</h2>
            </div>

            <div class="row benefit-notes">
                @if (count($bundles) > 0)
                <div class="row collections">
                    @foreach ($bundles as $bundle)
                   
                        <div class="col-md-4   col-xs-6 item" style="margin-bottom: 20px">
                            @include('frontend.layouts.partials.bundle_box_new')

                        </div>
                       
                    @endforeach
                </div>
                @else
                    <h4 class="text-center">@lang('labels.general.no_data_available')</h4>
                @endif

               
            </div>
            {!! $bundles->render() !!}
        </div>
    </section>
    
@endsection