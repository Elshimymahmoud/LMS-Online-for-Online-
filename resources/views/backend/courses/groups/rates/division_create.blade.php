@extends('backend.layouts.app')
@section('title', __('labels.backend.rates.division.create') . ' | ' . app_name())

@push('after-styles')
    <style>
        .form-control-label {
            line-height: 35px;
        }

        .remove {
            float: right;
            color: red;
            font-size: 20px;
            cursor: pointer;
        }

        .error {
            color: red;
        }

        .delete_quest {
            position: absolute;
            left: 10px;
            top: 10px;
            z-index: 99999;
        }

    </style>

@endpush
@section('content')
    {{ html()->form('POST', route('admin.groups.rate.division.store', ['rate'=>$rate->id]))->id('impact-create')->class('form-horizontal')->acceptsFiles()->open() }}
    <div class="alert alert-danger d-none" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="error-list">
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.rates.division.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.groups.rates.divisions', ['rate'=>$rate->id]) }}"
                   class="btn btn-primary">&#8592</a>

            </div>
        </div>
        <div class="card-body">

            <div class="row form-group">
                {{ html()->label(__('labels.backend.impact.fields.impact_title_ar'))->class('col-md-2 form-control-label')->for('impact_title_ar') }}
                <div class="col-md-10">
                    {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control ']) !!}
                </div>
                <!--col-->
            </div>

            <div class="row form-group">
                {{ html()->label(__('labels.backend.impact.fields.impact_title'))->class('col-md-2 form-control-label')->for('impact_title') }}

                <div class="col-md-10">
                    {!! Form::text('title', old('title'), ['class' => 'form-control ']) !!}
                </div>
            </div>


            <div class="questions" id="questions">

            </div>
            {{ html()->hidden('rate_id', $rate->id) }}

            <div class="row">
                <div class="col-12 form-group">
                    <a href="javascript:void(0)" class="btn btn-success add_question">{{ trans('labels.backend.questions.fields.add_question') }}</a>
                </div>
            </div>



            <div class="row">
                <div class="col-12 form-group">

                    {!! Form::checkbox('published') !!}
                    {!! Form::label('published', trans('labels.backend.tests.fields.published'), ['class' => 'control-label font-weight-bold']) !!}

                </div>
            </div>
            <div class="form-group row justify-content-center">
                <div class="col-4">
                    <a href="{{ route('admin.groups.rates.divisions', ['rate'=>$rate->id]) }}" class="btn btn-primary"> {{__('buttons.general.cancel')}}</a>
                    <!-- {{ form_cancel(route('admin.forms.index', ['form_type' => 'impact_measurments']), __('buttons.general.cancel')) }} -->

                    <button class="btn btn-success pull-right"
                            type="submit">{{ __('buttons.general.crud.create') }}</button>
                </div>
            </div>
            <!--col-->
        </div>
    </div>


    {{ html()->form()->close() }}
@endsection

@push('after-scripts')
    <script>
        $(document).ready(function() {

            count_question = 0;
            $(".add_question").click(function() {
                count_question++;

                var new_ques =
                    '<div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px;position:relative">' +
                    '<span class="delete_quest"><i class="fa fa-times"></i></span>' +
                    '<div class="col-4 form-group">' +
                    '<label for="">{{ trans('labels.backend.questions.fields.question') }}</label>' +
                    '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.question') }}" name="q[' +
                    count_question + '][question]" type="text">' +
                    '</div>' +
                    '<div class="col-4 form-group">' +
                    '<label for="">{{ trans('labels.backend.questions.fields.question_ar') }}</label>' +
                    '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.question_ar') }}" name="q[' +
                    count_question + '][question_ar]" type="text">' +
                    '</div>' +
                    '<div class="col-4 form-group">' +
                    '<label for="">{{ trans('labels.backend.questions.fields.question_type') }}</label>' +
                    '<select class="form-control question_type" name="q[' + count_question +
                    '][question_type]">' +

                    {{--'<option value="short_answer">{{ trans('labels.backend.questions.fields.short_answer') }}</option>' +--}}
                    {{--'<option value="paragraph">{{ trans('labels.backend.questions.fields.paragraph') }}</option>' +--}}
                    {{--'<option value="multiple_choice">{{ trans('labels.backend.questions.fields.multiple_choice') }}</option>' +--}}
                    {{--'<option value="drop_down">{{ trans('labels.backend.questions.fields.drop_down') }}</option>' +--}}
                    {{--'<option value="file_upload">{{ trans('labels.backend.questions.fields.file_upload') }}</option>' +--}}
                    {{--'<option value="date">{{ trans('labels.backend.questions.fields.date') }}</option>' +--}}
                    '<option value="radio">{{ trans('labels.backend.questions.fields.select_type') }}</option>' +
                    '<option value="radio">{{ trans('labels.backend.questions.fields.radio') }}</option>';


                    new_ques += '<option value="short_answer">{{ trans('labels.backend.questions.fields.short_answer') }}</option>' +
                    '<option value="paragraph">{{ trans('labels.backend.questions.fields.paragraph') }}</option>' +
                    '<option value="multiple_choice">{{ trans('labels.backend.questions.fields.multiple_choice') }}</option>' +
                    '<option value="true_false">{{ trans('labels.backend.questions.fields.true_false') }}</option>' +
                    '<option value="drop_down">{{ trans('labels.backend.questions.fields.drop_down') }}</option>' +
                    '<option value="file_upload">{{ trans('labels.backend.questions.fields.file_upload') }}</option>' +
                    '<option value="date">{{ trans('labels.backend.questions.fields.date') }}</option>';

                new_ques += '</select>' +
                    '</div>' +
                    '<div class="col-12 form-group form-body">' +
                    '<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.radio') }}" disabled="" >'+
                    '</div>' +
                    '</div>';
                console.log("questions", new_ques);

                $("#questions").append(new_ques)
                    .ready(function() {

                        $(".delete_quest").click(function() {
                            // alert('remove');
                            $(this).parents('.row').remove()
                        });

                        $(".question_type").change(function() {

                            switch ($(this).val()) {


                                case 'paragraph':
                                    html =
                                        '<textarea type="text" class="form-control"  autocomplete="off"  style="color:#000" value="paragraph" disabled="" >{{ trans('labels.backend.questions.fields.paragraph') }}</textarea>';
                                    break;

                                case 'file_upload':
                                    html =
                                        '<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.file_upload') }}" disabled="" >';
                                    break;

                                case 'date':
                                    html =
                                        '<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.date') }}" disabled="" >';
                                    break;

                                case 'time':
                                    html =
                                        '<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.time') }}" disabled="" >';
                                    break;
                                case 'true_false':
                                    html =
                                        '<div class="row options"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">' +
                                        '<div class="col-12 form-group">' +
                                        '<h6>{{ trans('labels.backend.questions.fields.options') }}</h6>' +
                                        '</div>' +
                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>' +
                                        '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q[' +
                                        count_question + '][option_text_ar][]" type="text" value="أجل">' +
                                        '</div>' +
                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>' +
                                        '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q[' +
                                        count_question + '][option_text][]" type="text" value="Yes">' +
                                        '</div>' +
                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>' +
                                        '<div><input name="q[' + count_question +
                                        '][correct][0]" type="checkbox" value=1 ></div>' +
                                        '</div>' +

                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>' +
                                        '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q[' +
                                        count_question + '][option_text_ar][]" type="text" value="لا">' +
                                        '</div>' +
                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>' +
                                        '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q[' +
                                        count_question + '][option_text][]" type="text" value="No">' +
                                        '</div>' +

                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>' +
                                        '<div><input name="q[' + count_question +
                                        '][correct][1]" type="checkbox"  value=1 ></div>' +
                                        '</div>' +
                                        '<div class="more_option col-12">' +
                                        '</div>' +
                                        '<div class="col-12 form-group">' +
                                        '<a href="javascript:void(0)" class="btn btn-success add_option"> + </a>' +
                                        '</div>';
                                    break;
                                case 'multiple_choice':
                                case 'drop_down':
                                    html =
                                        '<div class="row options"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">' +
                                        '<div class="col-12 form-group">' +
                                        '<h6>{{ trans('labels.backend.questions.fields.options') }}</h6>' +
                                        '</div>' +

                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>' +
                                        '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q[' +
                                        count_question + '][option_text_ar][]" type="text">' +
                                        '</div>' +

                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>' +
                                        '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q[' +
                                        count_question + '][option_text][]" type="text">' +
                                        '</div>' +

                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>' +
                                        '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q[' +
                                        count_question + '][option_text][]" type="text">' +
                                        '</div>' +

                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>' +
                                        '<div><input name="q[' + count_question +
                                        '][correct][0]" type="checkbox" value=1 ></div>' +
                                        '</div>' +
                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>' +
                                        '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q[' +
                                        count_question + '][option_text_ar][]" type="text">' +
                                        '</div>' +
                                        '<div class="col-4 form-group">' +
                                        '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>' +
                                        '<div><input name="q[' + count_question +
                                        '][correct][1]" type="checkbox"  value=1 ></div>' +
                                        '</div>' +
                                        '<div class="more_option col-12">' +
                                        '</div>' +
                                        '<div class="col-12 form-group">' +
                                        '<a href="javascript:void(0)" class="btn btn-success add_option"> + </a>' +
                                        '</div>';
                                    break;
                                case 'radio':
                                    html =
                                        '<input type="text" class="form-control"  autocomplete="off"  ' +
                                        'style="color:#000" value="{{ trans('labels.backend.questions.fields.radio')
                                        }}" disabled="" >';
                                    break;


                                case 'short_answer':
                                    html =
                                        '<input type="text" class="form-control"  autocomplete="off"  ' +
                                        'style="color:#000" value="{{ trans('labels.backend.questions.fields.short_answer')
                                        }}" disabled="" >';
                                    break;
                                default:
                                    html =
                                        '<input type="text" class="form-control"  autocomplete="off"  ' +
                                        'style="color:#000" value="{{ trans('labels.backend.questions.fields.radio')
                                        }}" disabled="" >';
                            }
                            count_option = 1;
                            $(this).parents('.row').find('.form-body').html(html)
                                .ready(function() {
                                    $('.add_option').click(function() {
                                        count_option++;
                                        option = '';
                                        option =
                                            '<div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">' +
                                            '<div class="col-4 form-group">' +
                                            '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>' +
                                            '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q[' +
                                            count_question +
                                            '][option_text][]" type="text">' +
                                            '</div>' +
                                            '<div class="col-4 form-group">' +
                                            '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>' +
                                            '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q[' +
                                            count_question +
                                            '][option_text_ar][]" type="text">' +
                                            '</div>' +
                                            '<div class="col-4 form-group">' +
                                            '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>' +
                                            '<div><input name="q[' +
                                            count_question + '][correct][' +
                                            count_option +
                                            ']" type="checkbox" value=1  ></div>' +
                                            '</div>';

                                        $(this).parents('.row').find('.more_option')
                                            .append(option)
                                    });
                                });
                        });
                    });
            });
        });
    </script>

@endpush
