@extends('frontend.layouts.app'.config('theme_layout'))


@push('after-styles')
<style>
    .leanth-course.go {
        right: 0;
    }
</style>
<link rel="stylesheet" href="https://cdn.plyr.io/3.5.3/plyr.css" />

<link href="{{asset('assets/rating/css/star-rating.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/rating/themes/krajee-svg/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
@endpush

@section('content')



<section class="details pt-50 pb-100" id="details">
    <div class="details-overlay">
        <div class="container-about" style="text-align: center">
            <div class="details-content" >
                <div class="row" style="display:inline-flex;text-align: center">
                   
                    <div class="jumbotron text-center">
                        <h1 class="display-3">@lang('labels.frontend.certificates.success_title')</h1>
                        <p class="lead"style='padding:10px'>@lang('labels.frontend.certificates.success_details')</p>
                        <hr>
                       
                        <p class="lead">
                          <a class="btn btn-primary btn-sm" href="{{url('/user/certificates')}}" role="button">@lang('labels.frontend.certificates.success_button')</a>
                        </p>
                      </div>

                </div>
            </div>
        </div>
    </div>
</section>




@endsection

@push('after-scripts')
<script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script>
<script src="{{asset('assets/rating/js/star-rating.js')}}"></script>

<script>
    const player = new Plyr('#player');

        $(document).on('change', 'input[name="stars"]', function () {
            $('#rating').val($(this).val());
        })
                @if(isset($review))
        var rating = "{{$review->rating}}";
        $('input[value="' + rating + '"]').prop("checked", true);
        $('#rating').val(rating);
        @endif
</script>
@endpush