@extends('frontend.layouts.app'.config('theme_layout'))
@section('title', trans('labels.frontend.course.bundles').' | '. app_name() )

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

        ul.pagination {
            display: inline;
            text-align: center;
        }
        .listing-filter-form select{
            height:50px!important;
        }

        .best-course-pic-text .best-course-text {
            padding: 20px;
        }
    </style>
@endpush
@section('content')

    <!-- Start of breadcrumb section
        ============================================= -->

        <section class="slide" style="background-image: url({{asset('ivory')}}/assets/img/slider/4.jpg);">
            <div class="slide-overlay">
                <div class="slide-content">
                    <h1>@if(isset($category)) {{$category->name}} @else @lang('labels.frontend.course.bundles') @endif </h1>
                </div>
            </div>
        </section>

    <!-- End of breadcrumb section
        ============================================= -->


    <!-- Start of course section
        ============================================= -->

        <section id="best-course" class="best-course-section mt-5">
            <div class="container-fluid">

                @if(Session::has('succsess'))
                <div class="alert alert-success">
                    {{ Session::get('succsess') }}
                </div>
              @endif
              @if(Session::has('error'))
              <div class="alert alert-danger">
                  {{ Session::get('error') }}
              </div>
            @endif
                <div class="desc related" style="margin-bottom: 0;padding-top: 0;padding-bottom: 0;">
                    <div class="container-custome related-overlay">            
           
                        <div class="row">
                            <div class="col-md-3 filter-head" >
                                @include('frontend.layouts.partials.course-filter')
            
                            </div>
                        @if(count($bundles) > 0 )
                        <div class="col-md-9">
                            @if(\Auth::check())
                            @if(isset($purchased_bundles))
                            @foreach($purchased_bundles as $bundle)
                            @if(in_array($bundle->id,$bundles->pluck('id')->toArray())==false)
                            <div class="col-md-4" style="float: left !important;">
                                @include('frontend.layouts.partials.bundle_box')
                            </div>
                            @endif
                        @endforeach
                        @endif
                        @endif

                            @foreach($bundles as $bundle)
                                
                            
                            <div class="col-md-4" style="float: left !important;">
                                @include('frontend.layouts.partials.bundle_box')
                            </div>

                            @endforeach
                        </div>
                        
                        @elseif(isset($purchased_bundles)&&count($purchased_bundles) > 0)
                        @foreach($purchased_bundles as $bundle)
                       
                        <div class="col-md-4" style="float: left !important;">
                            @include('frontend.layouts.partials.bundle_box')
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
                    location.href = '{{route('bundles.all')}}';
                }
            })

            @if(request('type') != "")
            $('#sortBy').find('option[value="' + "{{request('type')}}" + '"]').attr('selected', true);
            @endif
        });

    </script>
@endpush