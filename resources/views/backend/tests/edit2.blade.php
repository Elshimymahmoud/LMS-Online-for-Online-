@extends('backend.layouts.app')
@section('title', __('labels.backend.tests.title') . ' | ' . app_name())

{{-- {{ dd($test->questions) }} --}}
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

        .delete_quest {
            position: absolute;
            left: 10px;
            top: 10px;
            z-index: 99999;
        }
        .delete_option{
            position: relative;
            top: 57px;
            left: 31px;
        }
    </style>
@endpush
@section('content')

    {!! Form::model($test, ['method' => 'PUT', 'route' => ['admin.forms.update', $test->id],'files' => true]) !!}
    <input type="hidden" name="form_type" value="test">
    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.tests.edit')</h3>
            <div class="float-right">
                <a href="{{ route('admin.forms2.index2', ['course_id' => request('course_id'), 'form_type'=>'test']) }}" class="btn btn-success">@lang('labels.backend.tests.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                 <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('course_id', trans('labels.backend.tests.fields.course'), ['class' => 'control-label']) !!}
                    {!! Form::select('course_id', $courses, old('course_id') ?? $test->course, ['class' => 'form-control select2']) !!}
                </div>

                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('chapter_id', trans('labels.backend.lessons.fields.test_chapter'), ['class' => 'control-label']) !!}
                    {!! Form::select('chapter_id', $chapters, old('chapter_id'), ['class' => 'form-control select2']) !!}
                </div>
                <div class="col-lg-12 form-group">
                    {!! Form::label('course_location_label', trans('labels.backend.courses.fields.location').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('course_location_id[]', $courseLocations,$test->courseLocations, ['class' => 'form-control select2 col-12 col-lg-12  js-example-placeholder-multiple', 'multiple' => 'multiple','required'=>true]) !!}
                   
                    
                </div>
                <div class="col-12 col-lg-6  form-group">
                    {!! Form::label('title', trans('labels.backend.tests.fields.title'), ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.tests.fields.title')]) !!}
                </div>

                <div class="col-12 col-lg-6  form-group">
                    {!! Form::label('title', trans('labels.backend.tests.fields.title_ar'), ['class' => 'control-label']) !!}
                    {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.tests.fields.title_ar')]) !!}
                </div>

            </div>
           
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('downloadable_files', trans('labels.backend.lessons.fields.downloadable_files').' '.trans('labels.backend.lessons.max_file_size'), ['class' => 'control-label']) !!}
                    {!! Form::file('downloadable_files[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'id' => 'downloadable_files',
                        'accept' => "image/jpeg,image/gif,image/png,application/msword,audio/mpeg,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.ms-powerpoint,application/pdf,video/mp4"
                        ]) !!}
                     <div class="photo-block mt-3">
                        <div class="files-list">
                           
                            @if(count($test->downloadableMedia) > 0)
                                @foreach($test->downloadableMedia as $media)
                                    <p class="form-group">
                                        <a href="{{ asset('storage/uploads/'.$media->name) }}"
                                           target="_blank">{{ $media->name }}
                                            ({{ $media->size }} KB)</a>
                                        <a href="#" data-media-id="{{$media->id}}"
                                           class="btn btn-xs btn-danger delete remove-file">@lang('labels.backend.test.remove')</a>
                                    </p>
                                @endforeach
                            @endif
                        </div>
                    </div>
    
                </div>
            </div>
            @if (is_object($test->questions) && sizeof($test->questions) > 0)
                @foreach ($test->questions as $key => $question)
                <input type="hidden" value="{{ $question->id }}" name="q[{{$key}}][id]">
                    <div class="row"
                        style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px;position:relative">
                        <span class="delete_quest"><i class="fa fa-times"></i></span>
                        <div class="col-6 form-group">
                            <label for="">{{ trans('labels.backend.questions.fields.title') }}</label>
                            <input class="form-control" placeholder="{{ trans('labels.backend.questions.fields.title') }}" value="{{ $question->title }}" name="q[{{$key}}][title]" type="text">
                        </div>
                        <div class="col-6 form-group">
                            <label for="">{{ trans('labels.backend.questions.fields.title_ar') }}</label>
                            <input class="form-control" placeholder="{{ trans('labels.backend.questions.fields.title_ar') }}" value="{{ $question->title_ar }}" name="q[{{$key}}][title_ar]" type="text">
                        </div>
                        
                        <div class="col-6 form-group">
                            <label for="">{{ trans('labels.backend.questions.fields.question') }}</label>
                            <input class="form-control" required placeholder="{{ trans('labels.backend.questions.fields.question') }}" value="{{ $question->question }}" name="q[{{$key}}][question]" type="text">
                        </div>
                        <div class="col-6 form-group">
                            <label for="">{{ trans('labels.backend.questions.fields.question_ar') }}</label>
                            <input class="form-control" required  placeholder="{{ trans('labels.backend.questions.fields.question_ar') }}" value="{{ $question->question_ar }}" name="q[{{$key}}][question_ar]" type="text">
                        </div>
                        <div class="col-6 form-group">
                            <label for="">{{ trans('labels.backend.questions.fields.score') }}</label>
                            <input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.score') }}" value="{{ $question->score }}" name="q[{{$key}}][score]" type="text" pattern="[0-9]*">
                            <span style="color:red;font-size:10px">@lang('labels.backend.questions.fields.score_hint')</span>
                        </div>
                        <div class="col-6 form-group">
                            <label for="">{{ trans('labels.backend.questions.fields.question_type') }}</label>
                            <select class="form-control question_type" question_type_key="{{$key}}" name="q[{{$key}}][question_type]">
                                <option @if ($question->question_type == 'short_answer') selected @endif value="short_answer">{{ trans('labels.backend.questions.fields.short_answer') }}</option>
                                <option @if ($question->question_type == 'paragraph') selected @endif value="paragraph">{{ trans('labels.backend.questions.fields.paragraph') }}</option>
                                <option @if ($question->question_type == 'multiple_choice') selected @endif value="multiple_choice">{{ trans('labels.backend.questions.fields.multiple_choice') }}</option>
                                <option @if ($question->question_type == 'drop_down') selected @endif value="drop_down">{{ trans('labels.backend.questions.fields.drop_down') }}</option>
                                <option @if ($question->question_type == 'file_upload') selected @endif value="file_upload">{{ trans('labels.backend.questions.fields.file_upload') }}</option>
                                <option @if ($question->question_type == 'date') selected @endif value="date">{{ trans('labels.backend.questions.fields.date') }}</option>
                                <option @if ($question->question_type == 'time') selected @endif value="time">{{ trans('labels.backend.questions.fields.time') }}</option>
                                <option @if ($question->question_type == 'radio') selected @endif value="radio">{{ trans('labels.backend.questions.fields.radio') }}</option>
                            
                            </select>
                        </div>
                        <div class="col-12 form-group form-body">
                            @switch($question->question_type)
                                @case('paragraph')
                                    <textarea type="text" class="form-control" autocomplete="off" style="color:#000" value="paragraph" disabled="">{{ trans('labels.backend.questions.fields.paragraph') }}</textarea>
                                @break

                                @case('file_upload')
                                    <input type="text" class="form-control" autocomplete="off" style="color:#000" value="{{ trans('labels.backend.questions.fields.file_upload') }}" disabled="">
                                @break

                                @case('date')
                                    <input type="text" class="form-control" autocomplete="off" style="color:#000" value="{{ trans('labels.backend.questions.fields.date') }}" disabled="">
                                @break

                                @case('time')
                                    <input type="text" class="form-control" autocomplete="off" style="color:#000" value="{{ trans('labels.backend.questions.fields.time') }}" disabled="">
                                @break
                                    @case('radio')
                                    <input type="text" class="form-control" autocomplete="off" style="color:#000" value="{{ trans('labels.backend.questions.fields.radio') }}" disabled="">
                                @break


                                @case('multiple_choice')
                                @case('drop_down')
                                    <div class="row options" style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">
                                       
                                        <div class="col-12 form-group">
                                            <h6>{{ trans('labels.backend.questions.fields.options') }}</h6>
                                        </div>
                                        {{-- {{ dd($question->options) }} --}}
                                        @foreach ($question->options as $option_key => $option)
                                       
                                        <div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">
                                           
                                                   
                                        <input type="hidden" value="{{ $option->id }}" name="q[{{$key}}][option_id][]">
                                       @if($option_key>1)
                                          <span class="col-12 delete_option" style="left: 24px"><i class="fa fa-times"></i></span>

                                       @endif
                                        <div class="col-4 form-group">
                                            <label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>
                                            <input class="form-control option_text" value="{{$option->option_text}}" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q[{{$key}}][option_text][]" type="text">
                                        </div>
                                        <div class="col-4 form-group">
                                            <label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>
                                            <input class="form-control " value="{{$option->option_text_ar}}"  placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q[{{$key}}][option_text_ar][]" type="text">
                                        </div>
                                        <div class="col-4 form-group">
                                            <label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>
                                            <div><input @if ($option->correct == 1) checked  @endif name="q[{{$key}}][correct][{{$option_key}}]" type="checkbox" value=1></div>
                                        </div>
                                        </div>
                                       
                                       @endforeach

                                        <div class="more_option col-12">
                                        </div>
                                        <div class="col-12 form-group">
                                            <a href="javascript:void(0)" count_question2="{{$key}}" class="btn btn-success add_option"> + </a>
                                        </div>
                                    </div>
                                @break

                                @case('short_answer')
                                @default:
                                <input type="text" class="form-control" autocomplete="off" style="color:#000"  value="{{ trans('labels.backend.questions.fields.short_answer') }}" disabled="">

                            @endswitch
                        </div>
                    </div>

                @endforeach
            @endif
            <div class="row">
                <div class="col-12 form-group">
                    <div class="questions" id="questions"> </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-12 form-group">
                    <a href="javascript:void(0)" class="btn btn-success add_question">{{ trans('labels.backend.questions.fields.add_question') }}</a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::hidden('published', 0) !!}
                    {!! Form::checkbox('published', 1, old('published'), []) !!}
                    {!! Form::label('published', trans('labels.backend.tests.fields.published'), ['class' => 'control-label font-weight-bold']) !!}
                </div>
            </div>
        </div>
    </div>

{!! Form::submit(trans('strings.backend.general.app_update'), ['class' => 'btn  btn-danger']) !!}
{!! Form::close() !!}
@stop

@push('after-scripts')
    <script>

        $(document).ready(function () {
  // /// get course locations
  $('#course_id').on('change', function(e) {
                var course_id = e.target.value;
                $.ajax({
                    url: "{{ url('/user/getCourseLoc/ajax/') }}/"+course_id,
                    type: "GET", 
                    dataType: "json",                  
                    success: function(data) {                                                
                        $('select[name="course_location_id[]"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="course_location_id[]"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });   
                    }
                })
            });
            // ///
        count_question={{ sizeof($test->questions)-1}};
        $(".add_question").click(function(){
            count_question++;

            new_ques='<div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px;position:relative">'+
                        '<span class="delete_quest"><i class="fa fa-times"></i></span>'+
                        '<div class="col-6 form-group">'+
                            '<label for="">{{ trans('labels.backend.questions.fields.title') }}</label>'+
                            '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.title') }}" name="q['+count_question+'][title]" type="text">'+
                        '</div>'+
                        '<div class="col-6 form-group">'+
                            '<label for="">{{ trans('labels.backend.questions.fields.title_ar') }}</label>'+
                            '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.title_ar') }}" name="q['+count_question+'][title_ar]" type="text">'+
                        '</div>'+
                        '<div class="col-6 form-group">'+
                            '<label for="">{{ trans('labels.backend.questions.fields.question') }}</label>'+
                            '<input class="form-control " required placeholder="{{ trans('labels.backend.questions.fields.question') }}" name="q['+count_question+'][question]" type="text">'+
                        '</div>'+
                        '<div class="col-6 form-group">'+
                            '<label for="">{{ trans('labels.backend.questions.fields.question_ar') }}</label>'+
                            '<input class="form-control " required placeholder="{{ trans('labels.backend.questions.fields.question_ar') }}" name="q['+count_question+'][question_ar]" type="text">'+
                        '</div>'+
                        '<div class="col-6 form-group">'+
                            '<label for="">{{ trans('labels.backend.questions.fields.score') }}</label>'+
                            '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.score') }}" name="q['+count_question+'][score]" type="text" pattern="[0-9]*">'+
                            '<span style="color:red;font-size:10px">@lang('labels.backend.questions.fields.score_hint')</span>'+
                        '</div>'+
                        '<div class="col-6 form-group">'+
                            '<label for="">{{ trans('labels.backend.questions.fields.question_type') }}</label>'+
                            '<select class="form-control question_type" name="q['+count_question+'][question_type]">'+
                                '<option value="short_answer">{{ trans('labels.backend.questions.fields.short_answer') }}</option>'+
                                '<option value="paragraph">{{ trans('labels.backend.questions.fields.paragraph') }}</option>'+
                                '<option value="multiple_choice">{{ trans('labels.backend.questions.fields.multiple_choice') }}</option>'+
                                '<option value="drop_down">{{ trans('labels.backend.questions.fields.drop_down') }}</option>'+
                                '<option value="file_upload">{{ trans('labels.backend.questions.fields.file_upload') }}</option>'+
                                '<option value="date">{{ trans('labels.backend.questions.fields.date') }}</option>'+
                                '<option value="time">{{ trans('labels.backend.questions.fields.time') }}</option>'+
                                '<option value="radio">{{ trans('labels.backend.questions.fields.radio') }}</option>' +

                            '</select>'+
                        '</div>'+
                        '<div class="col-12 form-group form-body">'+
                            '<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="Short answer text" disabled="" >'+
                        '</div>'+
                    '</div>';
            $("#questions").append(new_ques)
            .ready(function () {

                $(".delete_quest").click(function(){
                    // alert('remove');
                    $(this).closest('.row')[0].remove()
                });
                $(".delete_option").click(function(){
                    // alert('remove');
                    $(this).parents('.row').remove()
                });
                $(".question_type").change(function(){
                    questcount=$($(this)[0]).attr('name').match(/\d+/);
                switch($(this).val()) {

               
                case 'paragraph':
                    html='<textarea type="text" class="form-control"  autocomplete="off"  style="color:#000" value="paragraph" disabled="" >{{ trans('labels.backend.questions.fields.paragraph') }}</textarea>';
                    break;

                case 'file_upload':
                    html='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.file_upload') }}" disabled="" >';
                    break;

                case 'date':
                    html='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.date') }}" disabled="" >';
                    break;

                case 'time':
                    html='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.time') }}" disabled="" >';
                    break;


                case 'multiple_choice':
                case 'drop_down':
                    html='<div class="row options"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">'+
                      
                           
                        '<div class="col-12 form-group">'+
                                '<h6>{{ trans('labels.backend.questions.fields.options') }}</h6>'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>'+
                                '<input class="form-control option_text" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+questcount+'][option_text][]" type="text">'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                                '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+questcount+'][option_text_ar][]" type="text">'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                                '<div><input name="q['+questcount+'][correct][0]" type="checkbox" value=1 ></div>'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>'+
                                '<input class="form-control option_text" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+questcount+'][option_text][]" type="text">'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                                '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+questcount+'][option_text_ar][]" type="text">'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                                '<div><input name="q['+questcount+'][correct][1]" type="checkbox"  value=1 ></div>'+
                            '</div>'+
                            '<div class="more_option col-12">'+
                            '</div>'+
                            '<div class="col-12 form-group">'+
                                '<a href="javascript:void(0)" class="btn btn-success add_option"> + </a>'+
                            '</div>';
                            
                    break;

                case 'short_answer':
                default:
                    html='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.short_answer') }}" disabled="" >';
                }

                $(this).closest('.row').find('.form-body').html(html)
                .ready(function () {
                   $('.add_option').click(function () {

                    count_option=$(this).closest('.row').find('.option_text').length+1;
                 
                    option='';
                    option='<div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">'+
                        '<span class="col-12 delete_option"><i class="fa fa-times"></i></span>'+
                               
                        '<div class="col-4 form-group" style="padding-right:0">'+
                                    '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>'+
                                    '<input class="form-control option_text" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+count_question+'][option_text][]" type="text">'+
                                '</div>'+
                                '<div class="col-4 form-group">'+
                                    '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                                    '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+count_question+'][option_text_ar][]" type="text">'+
                                '</div>'+
                                '<div class="col-4 form-group">'+
                                    '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                                    '<div><input name="q['+count_question+'][correct]['+count_option+']" type="checkbox" value=1  ></div>'+
                                '</div>';

                       $(this).closest('.row').find('.more_option').append(option)
                       $(".delete_option").click(function(){
                        // alert('remove');
                        $(this).parents('.row')[0].remove()
                   
                     });
                   }); 
                });
                });
            });
        });

       

       
        $(".delete_quest").click(function(){
                    // alert('remove');
                    $(this).closest('.row')[0].remove()
                });

                $(".question_type").change(function(){
                    count_question=$($(this)[0]).attr('name').match(/\d+/);
                switch($(this).val()) {

               
                case 'paragraph':
                    html='<textarea type="text" class="form-control"  autocomplete="off"  style="color:#000" value="paragraph" disabled="" >{{ trans('labels.backend.questions.fields.paragraph') }}</textarea>';
                    break;

                case 'file_upload':
                    html='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.file_upload') }}" disabled="" >';
                    break;

                case 'date':
                    html='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.date') }}" disabled="" >';
                    break;

                case 'time':
                    html='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.time') }}" disabled="" >';
                    break;


                case 'multiple_choice':
                case 'drop_down':
                    html='<div class="row options"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">'+
                            '<div class="col-12 form-group">'+
                                '<h6>{{ trans('labels.backend.questions.fields.options') }}</h6>'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>'+
                                '<input class="form-control option_text" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+count_question+'][option_text][]" type="text">'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                                '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+count_question+'][option_text_ar][]" type="text">'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                                '<div><input name="q['+count_question+'][correct][0]" type="checkbox" value=1 ></div>'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>'+
                                '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+count_question+'][option_text][]" type="text">'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                                '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+count_question+'][option_text_ar][]" type="text">'+
                            '</div>'+
                            '<div class="col-4 form-group">'+
                                '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                                '<div><input name="q['+count_question+'][correct][1]" type="checkbox"  value=1 ></div>'+
                            '</div>'+
                            '<div class="more_option col-12">'+
                            '</div>'+
                            '<div class="col-12 form-group">'+
                                '<a href="javascript:void(0)" count_question2='+count_question+' class="btn btn-success add_option"> + </a>'+
                            '</div>';
                    break;

                case 'short_answer':
                default:
                    html='<input type="text" class="form-control"  autocomplete="off"  style="color:#000" value="{{ trans('labels.backend.questions.fields.short_answer') }}" disabled="" >';
                }

                $(this).closest('.row').find('.form-body').html(html)
                .ready(function () {
                    $('.add_option').click(function () {
                   
                   count_option=$(this).closest('.row').find('.option_text').length+1;
                   count_question2=$(this).attr('count_question2');

                   option='';
                   option='<div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">'+
                        '<span class="col-12 delete_option"><i class="fa fa-times"></i></span>'+
                              
                    '<div class="col-4 form-group" style="padding-right:0">'+
                                   '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>'+
                                   '<input class="form-control option_text" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+count_question2+'][option_text][]" type="text">'+
                               '</div>'+
                               '<div class="col-4 form-group">'+
                                   '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                                   '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+count_question2+'][option_text_ar][]" type="text">'+
                               '</div>'+
                               '<div class="col-4 form-group">'+
                                   '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                                   '<div><input name="q['+count_question2+'][correct]['+count_option+']" type="checkbox" value=1  ></div>'+
                               '</div>';

                      $(this).closest('.row').find('.more_option').append(option)
                      $(".delete_option").click(function(){
                    // alert('remove');
                    $(this).parents('.row')[0].remove()
                   
                  

                });
                  }); 
                });
                });

                $('.add_option').click(function () {
                   
                    count_option=$(this).closest('.row').find('.option_text').length+1;
                    count_question2=$(this).attr('count_question2');

                    option='';
                    option='<div class="row"  style="background:#3bcfcb;margin: 1px;padding-top: 10px;border-radius:5px">'+
                        '<span class="col-12 delete_option"><i class="fa fa-times"></i></span>'+
                                
                        '<div class="col-4 form-group" style="padding-right:0">'+
                                    '<label for="">{{ trans('labels.backend.questions.fields.option_text') }}</label>'+
                                    '<input class="form-control option_text" placeholder="{{ trans('labels.backend.questions.fields.option_text') }}" name="q['+count_question2+'][option_text][]" type="text">'+
                                '</div>'+
                                '<div class="col-4 form-group">'+
                                    '<label for="">{{ trans('labels.backend.questions.fields.option_text_ar') }}</label>'+
                                    '<input class="form-control " placeholder="{{ trans('labels.backend.questions.fields.option_text_ar') }}" name="q['+count_question2+'][option_text_ar][]" type="text">'+
                                '</div>'+
                                '<div class="col-4 form-group">'+
                                    '<label for="">{{ trans('labels.backend.questions.fields.correct') }}</label>'+
                                    '<div><input name="q['+count_question2+'][correct]['+count_option+']" type="checkbox" value=1  ></div>'+
                                '</div>';

                       $(this).closest('.row').find('.more_option').append(option)
                       $(".delete_option").click(function(){
                    // alert('remove');
                    $(this).parents('.row')[0].remove()
                   
                  

                });
                   }); 


        });
        $(".delete_option").click(function(){
                        // alert('remove');
                        $(this).parents('.row')[0].remove()
                   
                     });

                     $(document).ready(function () {
            $(document).on('click', '.delete', function (e) {
                e.preventDefault();
                var parent = $(this).parent('.form-group');
                var confirmation = confirm('{{trans('strings.backend.general.are_you_sure')}}')
                if (confirmation) {
                    var media_id = $(this).data('media-id');
                    $.post('{{route('admin.media.destroy')}}', {media_id: media_id, _token: '{{csrf_token()}}'},
                        function (data, status) {
                            if (data.success) {
                                parent.remove();
                            } else {
                                alert('Something Went Wrong')
                            }
                        });
                }
            })
        });
</script>

@endpush
