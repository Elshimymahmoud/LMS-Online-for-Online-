@extends('frontend.layouts.app'.config('theme_layout'))
@section('title', trans('labels.frontend.course.courses').' | '. app_name() )

@push('after-styles')
    <style>
        .couse-pagination li.active {
            color: #333333 !important;
            font-weight: 700;
        }

        .page-link {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #c7c7c7;
            background-color: white;
            border: none;
        }

        .page-item.active .page-link {
            z-index: 1;
            color: #333333;
            background-color: white;
            border: none;

        }
     .listing-filter-form select{
            height:50px!important;
        }

        ul.pagination {
            display: inline;
            text-align: center;
        }
      
    </style>
@endpush
@section('content')

    <!-- Start of breadcrumb section
        ============================================= -->
    
    <section class="slide" style="background-image: url({{asset('ivory')}}/assets/img/slider/4.jpg);">
        <div class="slide-overlay">
            <div class="slide-content">
                <h1>@if(isset($category)) @if(session('locale') == 'ar') {{ $category->name_ar }} @else {{$category->name}}  @endif  @else @lang('labels.frontend.course.courses') @endif</h1>
          <br>
                <h4 style="color: white;text-align: center;">@if(isset($typeTitle)){{$typeTitle}}@endif</h4>
            </div>
        </div>
    </section>

    <!-- End of breadcrumb section
        ============================================= -->


    <!-- Start of course section
        ============================================= -->
        <section id="best-course" class="best-course-section {{isset($class) ? $class : ''}} mt-5">
            <div class="container-fluid">
               
           
                <div class="desc related" style="margin-bottom: 0;padding-top: 0;padding-bottom: 0;">
                    <div class="container-custome related-overlay">            
                        <div class="row">
                            @if(@isset($categories))
                                
                            <div class="col-md-3 filter-head" >
                                @include('frontend.layouts.partials.course-filter')
            
                            </div>
                            @endif
                        @if(count($courses) > 0)
                        <div class="col-md-9">
                            @if(\Auth::check() && isset($purchased_courses) && \Auth::user()->hasRole('student'))
                            @foreach(@$purchased_courses as $course)
                            @if(in_array($course->id,$courses->pluck('id')->toArray())==false)
                            <div class="col-md-4 col-sm-6 col-xs-6" style="float: left !important;">
                                @include('frontend.layouts.partials.course_box')
                            </div>
                            @endif
                        @endforeach
                        @endif
                            @foreach($courses as $course)
                                <div class="col-md-4 col-sm-6 col-xs-6" style="float: left !important;">
                                    @include('frontend.layouts.partials.course_box')
                                </div>
                            @endforeach
                           
                            
                        </div>
                        
                        @elseif(\Auth::check()&&  isset($purchased_courses)&& \Auth::user()->hasRole('student')&&count(@$purchased_courses) > 0)
                        @foreach(@$purchased_courses as $course)
                        
                        <div class="col-md-4 col-sm-6 col-xs-6" style="float: left !important;">
                            @include('frontend.layouts.partials.course_box')
                        </div>
                        
                    @endforeach
                        @else
                            <h4 class="text-center">@lang('labels.general.no_data_available')</h4>
                        @endif
        
                    </div>
                </div>
            </div>
            </div>
        </section>
        
    <!-- End of course section
        ============================================= -->

 


@endsection

@push('after-scripts')
    <script>
        $(document).ready(function () {
            $(document).on('change', '#sortBy', function () {
                if ($(this).val() != "") {
                    location.href = '{{url()->current()}}?type=' + $(this).val();
                } else {
                    location.href = '{{route('courses.all')}}';
                }
            })

            @if(request('type') != "")
            $('#sortBy').find('option[value="' + "{{request('type')}}" + '"]').attr('selected', true);
            @endif
        });

    </script>
@endpush