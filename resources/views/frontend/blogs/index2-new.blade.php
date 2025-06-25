@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')


@push('after-styles')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css" />
    <link href="{{ asset('plugins/touchpdf-master/jquery.touchPDF.css') }}" rel="stylesheet">

    <link href="{{ asset('iv') }}/assets/rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('iv') }}/assets/rating/themes/krajee-svg/theme.css" media="all" rel="stylesheet"
        type="text/css" />

    <link rel="stylesheet" href="{{ asset('iv') }}/css/blog_details.css" />
 
@endpush

@section('content')
  
<div class="row">

    <div class="container">



        <!--==========blog details  ==========-->
      
        <!--==========blog details  ==========-->
        <!--========== more blog details  ==========-->

        <div class="col-sm-12 col-md-12 collections   wow fadeInUp ptb-50 blogs-container mt-0">
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
        @if(count($blogs) > 0)
        @foreach($blogs as $item)
        <div class="blog-box item col-sm-6 col-md-4">
                @include('frontend.blogs.partials.blog_box_new')
        </div>
        @endforeach
    @else
        <h4 class="text-center">@lang('labels.general.no_data_available')</h4>
    @endif
           
        </div>
    </div>
</div>








@endsection

@push('after-scripts')
    <!-- custom js -->

  

    {{-- <script src="//www.youtube.com/iframe_api"></script> --}}

    <script src="{{ asset('plugins/sticky-kit/sticky-kit.js') }}"></script>
    <script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script>
    <script src="{{ asset('plugins/touchpdf-master/pdf.compatibility.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/pdf.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.touchSwipe.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.touchPDF.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.panzoom.js') }}"></script>
    <script src="{{ asset('plugins/touchpdf-master/jquery.mousewheel.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>



@endpush
