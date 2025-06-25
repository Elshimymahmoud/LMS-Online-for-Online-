@extends('backend.layouts.app')
@section('title', __('labels.backend.chapters.rearrange').' | '.app_name())

@push('after-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/amigo-sorter/css/theme-default.css')}}">
    <style>
        ul.sorter > span {
            display: inline-block;
            width: 100%;
            height: 100%;
            background: #f5f5f5;
            color: #333333;
            border: 1px solid #cccccc;
            border-radius: 6px;
            padding: 0px;
        }

        ul.sorter li > span .title {
            padding-left: 15px;
            width: 70%;
        }

        ul.sorter li > span .btn {
            width: 20%;
        }

        @media screen and (max-width: 768px) {

            ul.sorter li > span .btn {
                width: 30%;
            }

            ul.sorter li > span .title {
                padding-left: 15px;
                width: 70%;
                float: left;
                margin: 0 !important;
            }

        }


    </style>

@endpush

@section('content')



    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.tests.rearrange')</h3>
            {{-- <div class="float-right">
                <a href="{{ route('admin.tests.index') }}"
                   class="btn btn-success">@lang('labels.backend.tests.view')</a>
            </div> --}}
        </div>
      
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-12 form-group">
                    {{-- start test --}}
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-12  ">
                            <h4 class="">@lang('labels.backend.courses.course_timeline')</h4>
                            <p class="mb-0">@lang('labels.backend.courses.listing_note')</p>
                            <p class="">@lang('labels.backend.courses.timeline_description')</p>
                            <ul class="sorter d-inline-block">
    
                            @if (is_object($questions) && sizeof($questions) > 0)
                                 @foreach ($questions as $key => $question)
                                            
    
                                        <li>
                                            <span data-id="{{$question->id}}" data-sequence="{{$question->sequence}}">
                                                <p class="d-inline-block mb-0 btn btn-success">
                                                    @lang('labels.backend.tests.qust')
                                                 </p>
                                        @if($question)
                                        <p class="title d-inline ml-2">{{  (session('locale') == 'ar')?($question->question_ar??$question->question):($question->question??$question->question_ar)}}</p>
                                        @endif
                                         </span>
    
                                  
                                @endforeach
                                @endif
                            </ul>
                            <a href="{{ route('admin.courses.groups.tests2.index')  }}"
                                class="btn btn-default border float-left">@lang('strings.backend.general.app_back_to_list')</a>
    
                            <a href="#" id="save_timeline"
                               class="btn btn-primary float-right">@lang('labels.backend.courses.save_timeline')</a>
                        </div>
                    </div>

                </div>
            </div>
 
         
  
 
           
        </div>
    </div>

  



@stop

@push('after-scripts')
    <script src="{{asset('plugins/amigo-sorter/js/amigo-sorter.min.js')}}"></script>
    <script>
        $(function () {
            $('ul.sorter').amigoSorter({
                li_helper: "li_helper",
                li_empty: "empty",
            });
            $(document).on('click', '#save_timeline', function (e) {
                e.preventDefault();
                var list = [];
                $('ul.sorter li').each(function (key, value) {
                    key++;
                    var val = $(value).find('span').data('id');
                    list.push({id: val, sequence: key});
                });

                $.ajax({
                    method: 'POST',
                    url: "{{route('admin.courses.groups.tests2.saveSequence')}}",
                    data: {
                        _token: '{{csrf_token()}}',
                        list: list
                    }
                }).done(function (data) {
                   
                    location.reload();
                });
            })
        });

    </script>
@endpush