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
        .headerr{
            top: 15%;
            /* width:80%;  */
            height:100px; 
            background:white; 
            /* position:fixed; */
            text-align: center;
            -webkit-box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
                -moz-box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
                box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
                border: 1px solid #d7cece;
                padding: 20px;
                color: darkslategray;
                font-size: x-large;
                border-radius: 7px;
}

    </style>

@endpush

@section('content')
@if(@$currentCourseLocation)
<nav aria-label="breadcrumb" class="headerr ">
<ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}"><i class="fa fa-home" ></i></a></li>
      <li class="breadcrumb-item">   {{session('locale')=='ar'?$course->type->name_ar:$course->type->name}} </li>
      <li class="breadcrumb-item" style="color:red">{{session('locale')=='ar'?$course->title_ar:$course->title}}</li>

      
    </ol>
  </nav>
  @endif
    <div class="card"style="margin-top: 2%;">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.chapters.rearrange')</h3>
            <div class="float-right">
                <!-- <a href="{{ route('admin.chapters2.index2') }}"
                   class="btn btn-success">@lang('labels.backend.chapters.view')</a> -->
                   <a href="{{ route('admin.courses.index') }}"
                    class="btn btn-primary">&#8592</a>

                </div>
           
        </div>

        <div class="card-body">
           
            <div class="row">
                <div class="col-12 col-lg-12 form-group">
                    {{-- start chapters --}}
                    @if(count($chapters) > 0)
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-12  ">
                            <h4 class="">@lang('labels.backend.courses.course_timeline')</h4>
                            <p class="mb-0">@lang('labels.backend.courses.listing_note')</p>
                            <p class="">@lang('labels.backend.courses.timeline_description')</p>
                            <ul class="sorter d-inline-block">
    
                                @foreach($chapters as $key=>$item)
    
                                    @if( $item->published == 1)
    
                                        <li>
                                            <span data-id="{{$item->id}}" data-sequence="{{$item->sequence}}">
                                                <p class="d-inline-block mb-0 btn btn-success">
                                                    @lang('labels.backend.chapters.title')
                                                 </p>
                                        @if($item)
                                        <p class="title d-inline ml-2">{{  (session('locale') == 'ar')?($item->title_ar??$item->title):($item->title??$item->title_ar)}}</p>
                                        @endif
                                         </span>
    
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            <!-- <a href="{{ route('admin.chapters.index') }}"
                               class="btn btn-default border float-left">@lang('strings.backend.general.app_back_to_list')</a>
     -->
                            <a href="#" id="save_timeline"
                               class="btn btn-primary float-right">@lang('labels.backend.courses.save_timeline')</a>
    
                        </div>
    
                    </div>
                @endif
                    {{-- end chapters --}}
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
                    url: "{{route('admin.chapters.saveSequence')}}",
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