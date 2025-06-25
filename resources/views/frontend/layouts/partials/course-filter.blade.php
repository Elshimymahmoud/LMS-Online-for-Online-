
@push('after-styles')
<style>
    .filter-head{
        border: 2px black solid;
        border-top: 10px #3bcfcbsolid;
        border-radius: 18px;
    }
    .filter_heading{
        padding-top: 10px;
        color: ##3bcfcb;
    }
    .courseType{
        border-style: outset;
        padding: 10px;
    }
    .courseTypeInput{
        margin-bottom: 12px;
    }
</style>
@endpush
<form action="{{route('courses.search')}}" method="POST">
@csrf

    <div class="">

        
<div class="">

    <div class="filter_heading">
        <h2>@lang('labels.backend.courses.fields.category')</h2>
        <div class="toggler"></div>
        <hr>
    </div>

    <div class="filter_content" style="">

        @foreach ($categories as $category)
        <div class="stm_lms_courses__filter_category">
            <label class="stm_lms_styled_checkbox">
            <span class="stm_lms_styled_checkbox__inner">
                @if(isset($checkedCategory)&& in_array($category->id,$checkedCategory))
                <input type="checkbox" checked value="{{$category->id}}" name="category[]">
               @else
               <input type="checkbox"  value="{{$category->id}}" name="category[]">

               @endif
                {{-- <span><i class="fa fa-check"></i> </span> --}}
            </span>
            @if(Lang::locale()=="en")
                <span>{{$category->name}}</span>
            @else
            <span>{{$category->name_ar}}</span>
            @endif
            </label>
            <hr>
        </div>
        @endforeach
      

        
          <div class="row">
            <div class="col-md-12">
                @if(@$type=='App\Models\Course')
                <div class="form-group courseType">
                    {!! Form::label('type_id', trans('labels.backend.courses.fields.type'), ['class' => 'control-label dark-red']) !!}
                    {{-- {!! Form::select('type_id', $coursesTypes, old('type_id')??request()->type_id, ['class' => 'form-control mb-0 select2','style'=>'height:41px']) !!} --}}
                    <br>
                    @foreach ($coursesTypes as $key=>$coursesType)
                    @if(request()->type_id==$key)
                    {!!Form::radio('type_id', $key, true,['class'=>'courseTypeInput']) !!} <span>{{$coursesType}}</span>
                    @else
                    {!!Form::radio('type_id', $key, false,['class'=>'courseTypeInput']) !!} <span>{{$coursesType}}</span>

                    @endif
                    @endforeach
                </div>
                
                    <div class=" form-group">
                        {!! Form::label('location_id',trans('labels.backend.courses.fields.location'), ['class' => 'control-label dark-red']) !!}
                        {!! Form::select('location_id', $locations, @$location_id, ['class' => 'form-control select2','id'=>'locations', 'multiple' => false, 'required' => false]) !!}
                    </div>
                
                @endif
                <div class="form-group">
                    <label style="width: 50%;float: right;" class="dark-red" for="from_price">{{ __('labels.frontend.course.price_from') }}</label>
                   
                   <label style="width: 50%" class="dark-red" for="to_price">{{ __('labels.frontend.course.price_to') }}</label>
                   
                </div>
                <div class="form-group">
                    <input style="width: 50%;float: right;"  type="number" value="{{@$min_price!=null?$min_price:''}}" name="from_price" class="form-control mb-0" placeholder="@lang('labels.frontend.course.price-search-placeholder')" min="0" id="">
                    <input style="width: 50%;" type="number" value="{{@$max_price?$max_price:''}}" name="to_price" class="form-control mb-0" placeholder="@lang('labels.frontend.course.price-search-placeholder')" min="0" id="">

                </div>
                <div class="form-group">
                    <label class="dark-red" for="to_price">{{ __('labels.frontend.course.price_to') }}</label>
                   
                   <input type="number" value="{{@$max_price?$max_price:''}}" name="to_price" class="form-control mb-0" placeholder="@lang('labels.frontend.course.price-search-placeholder')" min="0" id="">
                </div>

                <div class="  form-group">
                    {!! Form::label('start_date', trans('labels.backend.courses.fields.start_date').' (yyyy-mm-dd)', ['class' => 'control-label dark-red']) !!}
                   <input type="date" value="{{@$startDate?$startDate:''}}" name="start_date" pattern ='(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))' name="start_date" class="form-control date" id="">
                    

                </div>
            </div>
          </div>
        
        
          
        
    </div>

</div>



        
<div class="stm_lms_courses__filter stm_lms_courses__search">

<div class="filter_heading">
    <h3>@lang('labels.backend.courses.search')</h3>
    <div class="toggler"></div>
</div>

<div class="stm_lms_courses__filter_content" style="display: none;">
    <input type="text" name="search" value="" placeholder="Keywords">
</div>

</div>
        <div class="stm_lms_courses__filter_actions">

            <input type="submit" class="heading_font" value="@lang('labels.backend.courses.show_result')">

            <a href="{{route('courses.all')}}" class="stm_lms_courses__filter_reset">
                <i class="fas fa-sync-alt"></i>
                <span>@lang('labels.backend.courses.reset')</span>
            </a>

        </div>

    </div>

    <input type="hidden" name="is_lms_filter" value="1">
    <input type="hidden" value="{{@$type}}" name="type">

</form>