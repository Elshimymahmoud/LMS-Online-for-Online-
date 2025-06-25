@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.home.title').' | '.app_name())
@section('meta_description', '')
@section('meta_keywords','')


@push('after-styles')

<link rel="stylesheet" href="{{ asset('landing') }}/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('landing') }}/assets/css/all.min.css">
<link rel="stylesheet" href="{{ asset('landing') }}/assets/css/icofont.min.css">
<link rel="stylesheet" href="{{ asset('landing') }}/assets/css/lightcase.css">
<link rel="stylesheet" href="{{ asset('landing') }}/assets/css/swiper.min.css">
<link rel="stylesheet" href="{{ asset('landing') }}/assets/css/style.css">

@endpush
@section('content')
@endsection


@push('after-scripts')
<script src="{{ asset('landing') }}/assets/js/jquery.js"></script>
<script src="{{ asset('landing') }}/assets/js/fontawesome.min.js"></script>
<script src="{{ asset('landing') }}/assets/js/waypoints.min.js"></script>
<script src="{{ asset('landing') }}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('landing') }}/assets/js/swiper.min.js"></script>
<script src="{{ asset('landing') }}/assets/js/circularProgressBar.min.js"></script>
<script src="{{ asset('landing') }}/assets/js/isotope.pkgd.min.js"></script>
<script src="{{ asset('landing') }}/assets/js/lightcase.js"></script>
<script src="{{ asset('landing') }}/assets/js/functions.js"></script>
@endpush