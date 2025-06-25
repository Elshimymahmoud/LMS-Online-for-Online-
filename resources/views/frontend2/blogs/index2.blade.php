@extends('frontend.layouts.app'.config('theme_layout'))
@section('title', trans('labels.frontend.blog.title').' | '.app_name())


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
    <section dir="rtl" id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold">@if(isset($category)){{$category->name}} @elseif(isset($tag)) {{$tag->name}} @endif  <span>@lang('labels.frontend.blog.title')</span></h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
        ============================================= -->


    <!-- Start of course section
        ============================================= -->
        <section id="best-course" class="best-course-section {{isset($class) ? $class : ''}} mt-5">
            <div class="container">
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
                        @if(count($blogs) > 0)
                            @foreach($blogs as $item)
                                <div class="col-md-4">
                                    @include('frontend.blogs.partials.blog_box')
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