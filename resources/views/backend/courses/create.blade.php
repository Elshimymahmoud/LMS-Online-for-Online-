@extends('backend.layouts.app')
@section('title', __('labels.backend.courses.title').' | '.app_name())
@push('after-styles')
<style>
  .link-wrapper {
    border: 1px solid #ccc;
    padding: 5px;
    margin-bottom: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f9f9f9;
  }

  .link-wrapper span{
    display: flex;
    flex-direction: row;
    gap: 10px;
  }

  .remove-link-btn {
    border: none;
    background-color: #4f198d;
    color: white;
    cursor: pointer;
    padding: 2px 6px;
    border-radius: 50%;
  }
  .rate-title {
    color: #802d42;
    font-weight: bold;
    padding: 5px;
    border-bottom: 1px solid;
    margin-bottom: 17px;

  }

  label {
    font-size: 14px;
    line-height: 22px;
    padding: 5px;
    font-weight: 600;
  }



  select option:hover {
    background-color: #6e0b25;
    color: #fff;
  }

  /* span {
    color: #6e0b25;
  } */

  .craete-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid #E6E9ED;
    padding: 10px 0;
    margin-bottom: 20px;
  }

  label.two {
    display: flex !important;
    align-items: center;
  }

  label.two b {
    margin: auto 5px;
    line-height: 28px;
  }

  .craete-title h3 {
    font-size: 20px;
    line-height: 28px;
    font-weight: 700;
  }

  body {
    background-color: #F7F7F7;
    font-family: 'Cairo', sans-serif;
  }

  #createbtn {
    text-decoration: none;
    color: #000;
    background-color: #6e0b25;
    display: block;
    padding: 8px 10px;
    color: #ffffff;
    border-radius: 4px;
    height: 40px;
    text-align: center;
    max-width: 150px;
    min-width: 100px;
    width: 150px;
    font-size: 14px;
    margin-top: 10px;
    margin-bottom: 10px;
    display: block;
    margin: 10px;

  }

  #createbtn.twobtn {
    margin: 10px auto;
  }

  .custom-select {
    position: relative;

  }

  .custom-select select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    padding: 10px;
    border: 1px solid #ccc;
    cursor: pointer;
  }

  .custom-select:after {
    content: '\25BC';
    position: absolute;
    top: 75%;
    left: 10px;
    transform: translateY(-50%);

    font-size: 12px;
    height: 16px;
    color: rgb(0, 0, 0, .6);

  }

  .two-part .custom-select:after {
    top: 55%;
  }

  input,
  select,
  textarea {
    font-size: 12px;
    line-height: 22px;
  }

  .form-btn {
    background-color: #6e0b25;
    color: #fff;
    display: inline-block;
    margin: auto;
    min-width: 200px;
    line-height: 28px;
    margin: 5px;
  }

  .dropdown {
    position: relative;
    display: block;
    width: 100%;
    font-size: 16px;
    border: none !important;
    line-height: 28px;
    outline: none !important;

  }

  .dropdown button {
    outline: none !important;
    border: none !important;
    width: 100%;
    padding: 6px 10px;
    text-align: start;
    /* background-color: #6e0b25; */
    /* color: #fff; */
    margin: 5px auto;
    border-radius: 4px;

  }

  .dropdown.open .dropdown-toggle:focus {
    outline: none !important;
    border: none !important;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    border: 1px solid #ccc;
    border-radius: 4px;
    z-index: 1;
  }

  .dropdown-content label {
    display: block;
    padding: 8px;
    cursor: pointer;
  }

  .dropdown-content label:hover {
    background-color: #ddd;
  }

  .dropdown.open .dropdown-content { 
    display: block;
    width: 100%;
    margin-left: 10px;
  }

  .dropdown-toggle::after {
    position: absolute;
    top: 50%;
    left: 10px;
  }



  .checkbox-wrapper-26 * {
    -webkit-tap-highlight-color: transparent;
    outline: none;
  }

  .checkbox-wrapper-26 input[type="checkbox"] {
    display: none;
  }

  .checkbox-wrapper-26 label {
    --size: 15px;
    height: 15px;
    --shadow: calc(var(--size) * .07) calc(var(--size) * .1);

    position: relative;
    display: block;
    width: 10px !important;

    margin: 0 auto;
    background-color: #6e0b25;
    border-radius: 50%;
    box-shadow: 0 var(--shadow) #ffbeb8;
    cursor: pointer;
    transition: 0.2s ease transform, 0.2s ease background-color,
      0.2s ease box-shadow;
    overflow: hidden;
    z-index: 1;
    text-align: center;
  }

  .checkbox-wrapper-26 label:before {
    content: "";
    position: absolute;
    top: 50%;
    right: 0;
    left: 0;
    width: calc(var(--size) * .7);
    height: calc(var(--size) * .7);
    margin: 0 auto;
    background-color: #fff;
    transform: translateY(-50%);
    border-radius: 50%;
    box-shadow: inset 0 var(--shadow) #ffbeb8;
    transition: 0.2s ease width, 0.2s ease height;
  }

  .checkbox-wrapper-26 label:hover:before {
    width: calc(var(--size) * .55);
    height: calc(var(--size) * .55);
    box-shadow: inset 0 var(--shadow) #ff9d96;
  }

  .checkbox-wrapper-26 label:active {
    transform: scale(0.9);
  }

  .checkbox-wrapper-26 .tick_mark {
    position: absolute;
    top: 0px;
    right: 1px;
    left: 0px;
    width: 8px;
    height: 10px;
    margin: 0 auto;
    margin-left: calc(var(--size) * .14);
    transform: rotateZ(-40deg);
  }

  .checkbox-wrapper-26 .tick_mark:before,
  .checkbox-wrapper-26 .tick_mark:after {
    content: "";
    position: absolute;
    background-color: #fff;
    border-radius: 2px;
    opacity: 0;
    transition: 0.2s ease transform, 0.2s ease opacity;
  }

  .checkbox-wrapper-26 .tick_mark:before {
    left: 0;
    bottom: 0;
    width: calc(var(--size) * .1);
    height: calc(var(--size) * .3);
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.23);
    transform: translateY(calc(var(--size) * -.68));
  }

  .checkbox-wrapper-26 .tick_mark:after {
    left: 0;
    bottom: 0;
    width: 100%;
    height: calc(var(--size) * .1);
    box-shadow: 0 3px 5px rgba(0, 0, 0, 0.23);
    transform: translateX(calc(var(--size) * .78));
  }

  .checkbox-wrapper-26 input[type="checkbox"]:checked+label {
    background-color: #6e0b25;
    box-shadow: 0 var(--shadow) #eee;
  }

  .checkbox-wrapper-26 input[type="checkbox"]:checked+label:before {
    width: 0;
    height: 0;
  }

  .checkbox-wrapper-26 input[type="checkbox"]:checked+label .tick_mark:before,
  .checkbox-wrapper-26 input[type="checkbox"]:checked+label .tick_mark:after {
    transform: translate(0);
    opacity: 1;
  }



  @media (min-width:776px) {
    .two-part {
      display: flex;
      justify-content: space-between;
      flex-direction: row;
    }

    #createbtn {
      margin: 0 10px;
    }

    #createbtn.twobtn {
      margin: 0 10px;
    }


  }

  .rate-title{
    margin-bottom: 1px !important;
  }

  /* @media (min-width:992px) {
    .dropdown {
      display: inline-block;
      width: 49.8%;
      margin: auto;


    }
  } */
</style>
  <style>
    .content-creator {
      display: flex;
      flex-direction: row-reverse;
      align-items: center;
      gap: 10px;
    }

    .sub-contents {
      padding-top: 1rem;
    }

    .addSubContentBtn {
      padding: 8px 12px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .removeSubContentBtn {
      padding: 1px 9px;
      background-color: #dc3545;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      /* height: 19px; */
    }

    .removeMainContentBtn {
      padding: 8px 12px;
      background-color: #dc3545;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    #contentCardsContainer {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 10px;
    }

    #mainContentInput {
      flex-grow: 1;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    #addContentBtn {
      padding: 8px 12px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .content-card {
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 15px;
      margin-top: 10px;
    }

    .sub-content-input {
      display: flex;
      gap: 10px;
      margin-top: 10px;
    }
  </style>
@endpush
@section('content')

{!! Form::open(['method' => 'POST', 'route' => ['admin.courses.store'], 'files' => true,'enctype'=>"multipart/form-data"]) !!}

<div class="card" style="      font-family: 'Cairo', sans-serif;">
  <div class="card-header">
    <h3 class="page-title float-left">@lang('labels.backend.courses.create')</h3>
    <div class="float-right" style="margin-right: 10px;">
      <a href="{{ route('admin.courses.index') }}" class="btn btn-primary">&#8592</a>
    </div>
    <!-- <div class="float-right">
                <a href="{{ route('admin.courses.index') }}"
                   class="btn btn-success">@lang('labels.backend.courses.view')</a>
            </div> -->
  </div>

  <div class="card-body">
    <!-- {{-- @if (Auth::user()->isAdmin())
                <div class="row">
                    <div class="col-10 form-group">
                        {!! Form::label('teachers',trans('labels.backend.courses.fields.teachers'), ['class' => 'control-label col-form-label']) !!}
                        {!! Form::select('teachers[]', $teachers, old('teachers'), ['class' => 'form-control select2 js-example-placeholder-multiple', 'multiple' => 'multiple', 'required' => true]) !!}
                    </div>
                    <div class="col-2 d-flex form-group flex-column">
                        OR <a target="_blank" class="btn btn-primary mt-auto"
                              href="{{route('admin.teachers.create')}}">{{trans('labels.backend.courses.add_teachers')}}</a>
                    </div>
                </div>
            @endif --}} -->
    <!-- <div class="row">
                    <div class="col-10 form-group">
                        {!! Form::label('teachers',trans('labels.backend.courses.fields.teachers'), ['class' => 'control-label col-form-label']) !!}
                        {!! Form::select('teachers[]', $teachers, old('teachers'), ['class' => 'form-control select2 js-example-placeholder-multiple', 'multiple' => 'multiple', 'required' => true]) !!}
                    </div>
                    <div class="col-2 d-flex form-group flex-column">
                        OR <a target="_blank" class="btn btn-primary mt-auto"
                              href="{{route('admin.teachers.create')}}">{{trans('labels.backend.courses.add_teachers')}}</a>
                    </div>
                </div> -->

      <div class="row">

      <div class="col-12 col-lg-12 form-group">
        {!! Form::label('title_ar', trans('labels.backend.courses.fields.title_ar').' *', ['class' => 'control-label']) !!}
        {!! Form::text('title_ar', old('title_ar'), ['class' => 'form-control', 'placeholder' => '', 'required' => 'true']) !!}
      </div>
      <div class="col-12 col-lg-12 form-group">
        {!! Form::label('title', trans('labels.backend.courses.fields.title').' *', ['class' => 'control-label']) !!}
        {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.courses.fields.title'), 'required' => false]) !!}
      </div>
     

      <div class="col-12 col-lg-12 form-group">

          {!! Form::label('short_description_ar', trans('labels.backend.courses.fields.short_description_ar').'  <span class="small_note">'.trans('labels.backend.courses.fields.short_description_note').'</span>', ['class' => 'control-label'],false) !!}
          {!! Form::textarea('short_description_ar', old('short_description_ar'), ['class' => 'form-control', 'rows' => 3, 'placeholder' => '']) !!}

        <span>
          <!-- {!! Form::hidden('short_desc_in_certificate', 0) !!}
                        {!! Form::checkbox('short_desc_in_certificate', 1, old('short_desc_in_certificate'), ['checked'=>'true']) !!} -->
          {{-- <input type="checkbox"  {{$course->short_desc_in_certificate==1? 'checked': ''}} name="short_desc_in_certificate" id=""> --}}
        </span>
        {!! Form::label('short_description', trans('labels.backend.courses.fields.short_description').' <span class="small_note">'.trans('labels.backend.courses.fields.short_description_note').'</span>', ['class' => 'control-label'],false) !!}
        {!! Form::textarea('short_description', old('short_description'), ['class' => 'form-control', 'rows' => 3, 'placeholder' => '']) !!}
      </div>
     
    </div>

    <div class="row">
      <div class="col-12 form-group">
          {!! Form::label('description_ar',trans('labels.backend.courses.fields.description_ar'), ['class' => 'control-label']) !!}
          {!! Form::textarea('description_ar', old('description_ar'), ['class' => 'form-control editor_ar','rows' => 5, 'placeholder' => trans('labels.backend.courses.fields.description_ar')]) !!}
      </div>
      <div class="col-12 form-group">
        {!! Form::label('description', trans('labels.backend.courses.fields.description'), ['class' => 'control-label']) !!}
        {!! Form::textarea('description', old('description'), ['class' => 'form-control editor','rows' => 5, 'placeholder' => trans('labels.backend.courses.fields.description')]) !!}
      </div>
    </div>

    <div class="row">
      {!! Form::label('content', trans('labels.backend.courses.fields.content'), ['class' => 'control-label']) !!}
      <div class="content-creator">
        <input type="text" id="mainContentInput" placeholder="@lang('labels.backend.courses.fields.main_content')" />
        <a id="addContentBtn">+</a>
      </div>
      <div id="contentCardsContainer"></div>
      {!! Form::hidden('courseContentsJson', '', ['id' => 'courseContentsJson']) !!}
    </div>

    <div class="row">
      <div class="col-12 form-group">
        {!! Form::label('type_id',trans('labels.backend.courses.fields.type'), ['class' => 'control-label']) !!}
        {!! Form::select('type_id', $types, old('type_id'), ['class' => 'form-control select2 js-example-placeholder-single', 'multiple' => false, 'required' => true]) !!}
      </div>
    </div>
    <div class="row">
      <div class="col-12 form-group">
        {!! Form::label('course_classification_id',trans('labels.backend.courses.fields.classification'), ['class' => 'control-label']) !!}
        {!! Form::select('course_classification_id', $course_classifications, old('course_classification_id'), ['class' => 'form-control select2 js-example-placeholder-single', 'multiple' => false, 'required' => true]) !!}
      </div>
    </div>
    <div class="row">
      <div class="col-12 form-group">
        {!! Form::label('category_id',trans('labels.backend.courses.fields.category'), ['class' => 'control-label']) !!}
        {!! Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control select2 js-example-placeholder-single', 'multiple' => false, 'required' => true]) !!}
      </div>
      <!-- <div class="col-2 d-flex form-group flex-column">
        OR <a target="_blank" class="btn btn-primary mt-auto" href="{{route('admin.categories.index').'?create'}}">{{trans('labels.backend.courses.add_categories')}}</a>
      </div> -->
    </div>
    <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('level_id', trans('labels.backend.courses.fields.level'), ['class' => 'control-label']) !!}
                    {!! Form::select('level_id', $levels, old('level_id'), ['class' => 'form-control select2 js-example-placeholder-single', 'multiple' => false, 'required' => true]) !!}
                </div>
    </div>
    <div class="row">
      {!! Form::label('linksContainer', trans('labels.frontend.course.resources'), ['class' =>
                'control-label']) !!}

      <!-- Input for title and link -->
      <div class="input-group mb-3" style="display: flex; flex-direction: row-reverse; gap: 10px;">
        <input type="text" id="linkInput" class="form-control" placeholder="@lang('labels.frontend.course.enter_resources')" aria-label="Resource Link">
        <input type="text" id="linkTitleInput" class="form-control" placeholder="@lang('labels.frontend.course.enter_resource_title')" aria-label="Resource Title">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" id="addLinkBtn" style="background-color: #4f198d">+</button>
        </div>
      </div>

      <!-- Container for displaying added links -->
      <div id="linksContainer"></div>

      <!-- Hidden input to store all links for form submission -->
      <input type="hidden" name="resourceLinks" id="resourceLinks">

    </div>
    

    <div class="row">
     

      <div class="col-12 col-lg-12 form-group">
        {!! Form::label('accreditation_number', trans('labels.backend.courses.fields.accreditation_number'), ['class' => 'control-label']) !!}
        {!! Form::text('accreditation_number', old('accreditation_number'), ['class' => 'form-control', 'placeholder' => '', 'required' => false,'pattern'=>"[0-9]*"]) !!}
        <span style='color:red;font-size:10px'>@lang('labels.backend.courses.accredation-type-msg')</span>

      </div>
      <div class="col-12 col-lg-12 form-group">
        {!! Form::label('slug', trans('labels.backend.courses.fields.slug'), ['class' => 'control-label']) !!}
        {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.courses.slug_placeholder')]) !!}

      </div>
    </div>
    <div class="row">
      {{-- <div class="col-12 col-lg-3 form-group">
                    {!! Form::label('price',  trans('labels.backend.courses.fields.price').' (in '.$appCurrency["symbol"].')', ['class' => 'control-label']) !!}
                    {!! Form::number('price', old('price'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.courses.fields.price'), 'pattern' => "[0-9]"]) !!}
                </div> --}}
      <div class="col-12 col-lg-12 form-group">
        {!! Form::label('course_image', trans('labels.backend.courses.fields.course_image'), ['class' => 'control-label']) !!}
        {!! Form::file('course_image', ['class' => 'form-control', 'accept' => 'image/jpeg,image/gif,image/png']) !!}
        {!! Form::hidden('course_image_max_size', 8) !!}
        {!! Form::hidden('course_image_max_width', 4000) !!}
        {!! Form::hidden('course_image_max_height', 4000) !!}

      </div>
      {{-- <div class="col-12 col-lg-3  form-group">
                    {!! Form::label('start_date', trans('labels.backend.courses.fields.start_date').' (yyyy-mm-dd)', ['class' => 'control-label']) !!}
                    {!! Form::text('start_date', old('start_date'), ['class' => 'form-control date','pattern' => '(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))', 'placeholder' => trans('labels.backend.courses.fields.start_date').' (Ex . 2019-01-01)', 'autocomplete' => 'off']) !!}

                </div> --}}

      {{-- <div class="col-12 col-lg-3 form-group">
                    {!! Form::label('end_date', trans('labels.backend.courses.fields.end_date').' (yyyy-mm-dd)', ['class' => 'control-label']) !!}
                    {!! Form::text('end_date', old('end_date'), ['class' => 'form-control date', 'pattern' => '(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))', 'placeholder' => trans('labels.backend.courses.fields.end_date').' (Ex . 2019-01-01)','autocomplete'=>"off"]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('end_date'))
                        <p class="help-block">
                            {{ $errors->first('end_date') }}
      </p>
      @endif
    </div> --}}
    <div class="row">
      <div class="col-md-12 form-group">
        {!! Form::label('add_video', trans('labels.backend.lessons.fields.add_video'), ['class' => 'control-label']) !!}

        {!! Form::select('media_type', ['youtube' => 'Youtube','vimeo' => 'Vimeo','upload' => 'Upload','embed' => 'Embed'],null,['class' => 'form-control', 'placeholder' => 'Select One','id'=>'media_type' ]) !!}

        {!! Form::file('video_file', ['class' => 'form-control mt-3 d-none', 'placeholder' => trans('labels.backend.lessons.enter_video_url'),'id'=>'video_file' ]) !!}

        {!! Form::text('video', old('video'), ['class' => 'form-control mt-3 d-none', 'placeholder' => trans('labels.backend.lessons.enter_video_url'),'id'=>'video' ]) !!}


        @lang('labels.backend.lessons.video_guide')

      </div>

      <div class="col-12 col-lg-12 form-group">
        {!! Form::label('pdf_files', trans('labels.backend.lessons.fields.add_pdf'), ['class' => 'control-label']) !!}
        {!! Form::file('add_pdf', [
        'class' => 'form-control file-upload',
        'id' => 'add_pdf',
        'accept' => "application/pdf"

        ]) !!}
      </div>
    </div>
    <div class="row">

      <div class="col-12 col-lg-6 form-group">
        {!! Form::label('pdf_title_ar', trans('labels.backend.courses.fields.pdf_title_ar'), ['class' => 'control-label']) !!}
        {!! Form::text('pdf_title_ar', old('pdf_title_ar'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.courses.fields.title_ar'), 'required' => false]) !!}
      </div>
      <div class="col-12 col-lg-6 form-group">
        {!! Form::label('pdf_title', trans('labels.backend.courses.fields.pdf_title'), ['class' => 'control-label']) !!}
        {!! Form::text('pdf_title', old('pdf_title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.courses.fields.title'), 'required' => false]) !!}
      </div>
    </div>


    <div class="row">
      <div class="col-12 form-group">
        <h5 class="rate-title" style="color: #000;"> </h5>
        <div class="dropdown">
          <button class=" dropdown-toggle" type="button" id="dropdownMenuButton1" aria-haspopup="true" aria-expanded="false">
            @lang('labels.backend.lessons.fields.status')
          </button>
          <div class="dropdown-content" aria-labelledby="dropdownMenuButton1" dir="ltr">
            <label class="two">
              <div class="checkbox-wrapper-26">
                {!! Form::hidden('published', 0) !!}
                {!! Form::checkbox('published', 1, false, []) !!}
                <label for="_checkbox-26">
                  <div class="tick_mark"></div>
                </label>
              </div>
              <b>{{trans('labels.backend.courses.fields.published')}}</b>
            </label>
            <label class="two">
              <div class="checkbox-wrapper-26">
                {!! Form::hidden('featured', 0) !!}
                {!! Form::checkbox('featured', 1, false, []) !!}
                <label for="_checkbox-26">
                  <div class="tick_mark"></div>
                </label>
              </div>
              <b>{{trans('labels.backend.courses.fields.featured')}}</b>
            </label>
            <label class="two">
              <div class="checkbox-wrapper-26">
                {!! Form::hidden('trending', 0) !!}
                {!! Form::checkbox('trending', 1, false, []) !!}
                <label for="_checkbox-26">
                  <div class="tick_mark"></div>
                </label>
              </div>
              <b>{{trans('labels.backend.courses.fields.trending')}}</b>
            </label>

          </div>
        </div>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12 form-group">
        {!! Form::label('meta_title',trans('labels.backend.courses.fields.meta_title'), ['class' => 'control-label']) !!}
        {!! Form::text('meta_title', old('meta_title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.courses.fields.meta_title')]) !!}

      </div>
      <div class="col-12 form-group">
        {!! Form::label('meta_description',trans('labels.backend.courses.fields.meta_description'), ['class' => 'control-label']) !!}
        {!! Form::textarea('meta_description', old('meta_description'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.courses.fields.meta_description')]) !!}
      </div>
      <div class="col-12 form-group">
        {!! Form::label('meta_keywords',trans('labels.backend.courses.fields.meta_keywords'), ['class' => 'control-label']) !!}
        {!! Form::textarea('meta_keywords', old('meta_keywords'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.courses.fields.meta_keywords')]) !!}
      </div>
    </div>
    <div class="col-12 form-group">

      {{ html()->label(__('labels.backend.general_settings.pixel_code'))->class('col-md-2 form-control-label')->for('pixel_code') }}
      {!! Form::textarea('pixel_code', old('pixel_code'), ['class' => 'form-control ', 'placeholder' => trans('labels.backend.general_settings.pixel_code')]) !!}



    </div>
    <div class="row">
      <div class="col-12  text-center form-group">

        {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-lg btn-danger']) !!}
      </div>
    </div>
  </div>
</div>
</div>
{!! Form::close() !!}


@stop

@push('after-scripts')
<script>
  $(document).ready(function() {
    $('#start_date').datepicker({
      autoclose: true,
      dateFormat: "{{ config('app.date_format_js') }}"
    });
    $('#end_date').datepicker({
      autoclose: true,
      dateFormat: "{{ config('app.date_format_js') }}"
    });
    $(".js-example-placeholder-single").select2({
      placeholder: "{{trans('labels.backend.courses.select_category')}}",
    });

    $(".js-example-placeholder-multiple").select2({
      placeholder: "{{trans('labels.backend.courses.select_teachers')}}",
    });
  });

  var uploadField = $('input[type="file"]');

  $(document).on('change', 'input[type="file"]', function() {
    var $this = $(this);
    $(this.files).each(function(key, value) {
      if (value.size > 5000000) {
        alert('"' + value.name + '"' + 'exceeds limit of maximum file upload size')
        $this.val("");
      }
    })
  })


  $(document).on('change', '#media_type', function() {
    if ($(this).val()) {
      if ($(this).val() != 'upload') {
        $('#video').removeClass('d-none').attr('required', true)
        $('#video_file').addClass('d-none').attr('required', false)
      } else if ($(this).val() == 'upload') {
        $('#video').addClass('d-none').attr('required', false)
        $('#video_file').removeClass('d-none').attr('required', true)
      }
    } else {
      $('#video_file').addClass('d-none').attr('required', false)
      $('#video').addClass('d-none').attr('required', false)
    }
  })

  document.addEventListener("DOMContentLoaded", function() {
    var dropdowns = document.querySelectorAll(".dropdown");
    dropdowns.forEach(function(dropdown) {
      dropdown.addEventListener("click", function() {
        this.classList.toggle("open");
      });


      window.addEventListener("click", function(event) {
        if (!dropdown.contains(event.target)) {
          dropdown.classList.remove("open");
        }
      });
    });
  });


  let courseContents = [];

  document.getElementById('addContentBtn').addEventListener('click', function() {
    const mainContent = document.getElementById('mainContentInput').value;
    if (mainContent) {
      const contentObject = { mainContent: mainContent, subContents: [] }; //create an object where we will store the main content
      courseContents.push(contentObject);

      const card = document.createElement('div');
      card.className = 'content-card';
      card.setAttribute('data-index', courseContents.length - 1); //data attribute to identify the main content
      card.innerHTML = `
      <div style="display: flex; justify-content: space-between;">
        <p>${mainContent}</p>
        <a class="removeMainContentBtn">x</a>
      </div>
      <div class="sub-content-input">
          <input type="text" placeholder="@lang('labels.backend.courses.fields.main_content')" class="subContentInput" />
          <a class="addSubContentBtn">+</a>
      </div>
      <div class="sub-contents"></div>


    `;

      document.getElementById('contentCardsContainer').appendChild(card);
      document.getElementById('mainContentInput').value = ''; // Clear the main content input

      // Add event listener to the "Add Sub Content" button inside the card
      card.querySelector('.addSubContentBtn').addEventListener('click', function() {
        console.log("clicked")
        const subContentInput = card.querySelector('.subContentInput');
        const subContent = subContentInput.value;
        if (subContent) {
          const subContentElement = document.createElement('div');
          subContentElement.innerHTML = `<div style="display: flex; justify-content: space-between;
          "><p style="margin:0;">${subContent}</p><a class="removeSubContentBtn">x</a></div>`;
          card.querySelector('.sub-contents').appendChild(subContentElement);
          subContentInput.value = ''; // Clear the sub content input

          // Find the corresponding main content object and add the sub-content
          const mainContentIndex = card.getAttribute('data-index');
          courseContents[mainContentIndex].subContents.push(subContent);

          // Add event listener to remove sub content
          subContentElement.querySelector('.removeSubContentBtn').addEventListener('click', function() {
            subContentElement.remove();
            courseContents[mainContentIndex].subContents = courseContents[mainContentIndex].subContents.filter(sub => sub !== subContent);
          });
        }
      });
      card.querySelector('.removeMainContentBtn').addEventListener('click', function() {
        card.remove();
        courseContents = courseContents.filter((_, index) => index.toString() !== card.getAttribute('data-index'));
      });
    }
  });

  // Before submitting the form, convert the courseContents array to a JSON string
  // and assign it to the hidden input field
  document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent the form from submitting immediately
    document.getElementById('courseContentsJson').value = JSON.stringify(courseContents);
    this.submit(); // Submit the form
  });
</script>

<script>
  document.getElementById('addLinkBtn').addEventListener('click', function() {
    const linkTitleInput = document.getElementById('linkTitleInput');
    const linkInput = document.getElementById('linkInput');
    const linksContainer = document.getElementById('linksContainer');
    const resourceLinksInput = document.getElementById('resourceLinks');

    const title = linkTitleInput.value.trim();
    const link = linkInput.value.trim();
    if (title && link) {
      // Create a container for the title, link, and the remove button
      const linkWrapper = document.createElement('div');
      linkWrapper.classList.add('link-wrapper');

      // Create the title element
      const titleElement = document.createElement('span');
      titleElement.innerHTML = `${title}: <a href="${link}" target="_blank">${link}</a>`;
      linkWrapper.appendChild(titleElement);

      // Create the remove button
      const removeBtn = document.createElement('button');
      removeBtn.textContent = 'X';
      removeBtn.classList.add('remove-link-btn');
      linkWrapper.appendChild(removeBtn);

      // Append the wrapper to the links container
      linksContainer.appendChild(linkWrapper);

      // Update the hidden input
      const resource = `${title}|${link}`;
      if (resourceLinksInput.value) {
        resourceLinksInput.value += ',' + resource;
      } else {
        resourceLinksInput.value = resource;
      }

      // Clear the input fields
      linkTitleInput.value = '';
      linkInput.value = '';

      // Add event listener to the remove button
      removeBtn.addEventListener('click', function() {
        const resourcesArray = resourceLinksInput.value.split(',');
        const resourceIndex = resourcesArray.indexOf(resource);
        if (resourceIndex > -1) {
          resourcesArray.splice(resourceIndex, 1);
          resourceLinksInput.value = resourcesArray.join(',');
        }
        linkWrapper.remove();
      });
    }
  });
</script>
@endpush