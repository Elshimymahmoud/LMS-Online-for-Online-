@extends('backend.layouts.app')
@section('title', __('labels.backend.tests.title').' | '.app_name())

@push('after-styles')
    <style>
        .select2-container--default .select2-selection--single {
            height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 35px;
        }

    </style>
    <link href="{{asset('assets/rating/css/star-rating.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/rating/themes/krajee-svg/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <style>
    .rating-container .star {
     display: unset;}
    </style>
@endpush
@section('content')

@if($tests_result->test->test->form_type=='complainment')
{!! Form::model($tests_result, ['method' => 'POST', 'route' => ['admin.reply_complaints.store', $tests_result->id]]) !!}

@else
    {!! Form::model($tests_result, ['method' => 'PUT', 'route' => ['admin.tests_result.update', $tests_result->id]]) !!}
@endif
    <div class="card">
        <div class="card-header">
           
            <h3 class="page-title float-left mb-0">
                @if($tests_result->test->test->form_type=='rate')
                @lang('labels.backend.rates.title') - {{Lang::locale()=='ar'?$tests_result->test->test->title_ar:$tests_result->test->test->title}} 
                @elseif($tests_result->test->test->form_type=='complainment')
                @lang('labels.backend.forms.reply_complaints') - {{Lang::locale()=='ar'?$tests_result->test->test->title_ar:$tests_result->test->test->title}} 
                @else
                @lang('labels.backend.tests.edit') - {{Lang::locale()=='ar'?$tests_result->test->test->title:$tests_result->test->test->title_ar}} 
                    
                @endif
             </h3>
            <div class="float-right">
                <a href="{{ route('admin.tests_result.index') }}" class="btn btn-success">@lang('labels.backend.tests_result.view') </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                
                @if($tests_result->test->test->form_type!='complainment')
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('title', trans('labels.backend.tests_result.fields.score'), ['class' => 'control-label']) !!}
                    {!! Form::text('test_result', old('test_result'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.tests_result.fields.title')]) !!}
                </div>
                @endif
                <div style="font-size: 26px;
                color: #802d42;
                font-weight: bold;" class="col-12 col-lg-12 form-group">
                    {!! Lang::locale()=='en'?$tests_result->test->test->title:$tests_result->test->test->title_ar !!}
                </div>
                <hr>
                @foreach($tests_result->answers as $answer)
              @if($answer->question!=null)
                <div class="col-12 col-lg-12 form-group">
                    <b> {!! Lang::locale()=='en'?$answer->question->question:$answer->question->question_ar !!}</b> <br>
                    @if($answer->question->question_type !='radio')
                    <textarea disabled style="margin: 10px;text-align:right;width:70%" class="form-control" name="answers" id=""  rows="3">
                    {!! !is_numeric($answer->option_id)?$answer->option_id:(option_txt($answer->option_id)?(option_txt($answer->option_id)->option_text):$answer->answer) !!}
                </textarea>
                <hr>
                    <div>{!! get_test_file($tests_result->user_id,$answer->question->id) !!}</div> 
                    @else
                    <div style="direction: ltr;display: inline-block;width: 100%">
                    <input name="{{$answer->question_id}}-options" id="kartik" class="rating" data-stars="5" disabled value="{{$answer->answer}}" data-step="0.1" title="" />
                    </div>
                    <hr>
                    @endif
                </div>
                
                @endif
                @endforeach

            </div>
           
            @if($tests_result->test->test->form_type=='complainment')
            <div class="col-12 col-lg-12 form-group">
            <textarea name="reply" id="" cols="75" rows="10"></textarea>
            <input type="hidden" name="user_id" value="{{$tests_result->user_id}}">
            </div>
            @endif
        </div>
    </div>

    {!! Form::submit(trans('strings.backend.general.app_update'), ['class' => 'btn  btn-danger']) !!}
    {!! Form::close() !!}
@stop

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