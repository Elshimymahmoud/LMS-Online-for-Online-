@extends('backend.layouts.app')
@section('title', __('labels.backend.teachers.title').' | '.app_name())
@push('after-styles')
<style>
    .iti {
     position: unset; 
    display: unset;
    }
</style>
@endpush
@push('after-styles')
    <style>
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
@endpush
@section('content')
    {{ html()->modelForm($teacher, 'PATCH', route('admin.teachers.update', $teacher->id))->class('form-horizontal')->acceptsFiles()->open() }}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.teachers.edit')</h3>
            <div class="float-right">
                <a href="{{ route('admin.teachers.index') }}"
                   class="btn btn-success">@lang('labels.backend.teachers.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">


                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.teachers.fields.name'))->class('col-md-2 form-control-label')->for('firstname') }}

                        <div class="col-md-10">
                            {{ html()->text('first_name')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.teachers.fields.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                                {{ html()->hidden('last_name')
                                ->class('form-control')
                                ->value('')
                                ->attribute('maxlength', 191)
                                 }}
                        </div><!--col-->
                    </div><!--form-group-->


                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.teachers.fields.name_ar'))->class('col-md-2 form-control-label')->for('name_ar') }}

                        <div class="col-md-10">
                            {{ html()->text('name_ar')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.teachers.fields.name_ar'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.teachers.fields.email'))->class('col-md-2 form-control-label')->for('email') }}

                        <div class="col-md-10">
                            {{ html()->email('email')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.teachers.fields.email'))
                                ->attributes(['maxlength'=> 191,'readonly'=>true])
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.teachers.fields.password'))->class('col-md-2 form-control-label')->for('password') }}

                        <div class="col-md-10">
                            {{ html()->password('password')
                                ->class('form-control')
                                ->value('')
                                ->placeholder(__('labels.backend.teachers.fields.password'))
}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.teachers.fields.image'))->class('col-md-2 form-control-label')->for('image') }}

                        <div class="col-md-10">
                            {!! Form::file('image', ['class' => 'form-control d-inline-block', 'placeholder' => '']) !!}
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.general_settings.user_registration_settings.fields.gender'))->class('col-md-2 form-control-label')->for('gender') }}
                        <div class="col-md-10">
                            <label class="radio-inline mr-3 mb-0">
                                <input type="radio" name="gender" value="male" {{ $teacher->gender == 'male'?'checked':'' }}> {{__('validation.attributes.frontend.male')}}
                            </label>
                            <label class="radio-inline mr-3 mb-0">
                                <input type="radio" name="gender" value="female" {{ $teacher->gender == 'female'?'checked':'' }}> {{__('validation.attributes.frontend.female')}}
                            </label>
                            <label class="radio-inline mr-3 mb-0">
                                <input type="radio" name="gender" value="other" {{ $teacher->gender == 'other'?'checked':'' }}> {{__('validation.attributes.frontend.other')}}
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.teachers.fields.phone'))->class('col-md-2 form-control-label')->for('phone') }}

                        <div class="col-md-10">
                            
                            <input class="form-control" name="phone" id="phone" value="{{$teacher->phone}}" type="tel" placeholder="@lang('labels.frontend.contact.phone_number')">
                            @if($errors->has('phone'))
                                <span class="help-block text-danger">{{$errors->first('phone')}}</span>
                            @endif
                    </div>
                    </div>
                    @php
                        $teacherProfile = $teacher->teacherProfile?$teacher->teacherProfile:'';
                        $payment_details = $teacher->teacherProfile?json_decode($teacher->teacherProfile->payment_details):new stdClass();
                    @endphp


                    <div class="form-group row">
                        {{ html()->label(__('labels.teacher.description'))->class('col-md-2 form-control-label')->for('description') }}

                        <div class="col-md-10">
                            {{ html()->textarea('description')
                                    ->class('form-control editor')
                                    ->value(@$teacherProfile->description)
                                    ->placeholder(__('labels.teacher.description')) }}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{ html()->label(__('labels.teacher.description_ar'))->class('col-md-2 form-control-label')->for('description_ar') }}

                        <div class="col-md-10">
                            {{ html()->textarea('description_ar')
                                    ->class('form-control editor_ar')
                                    ->value(@$teacherProfile->description_ar)
                                    ->placeholder(__('labels.teacher.description_ar')) }}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{ html()->label(__('labels.teacher.facebook_link'))->class('col-md-2 form-control-label')->for('facebook_link') }}

                        <div class="col-md-10">
                            {{ html()->text('facebook_link')
                                            ->class('form-control')
                                            ->value(@$teacherProfile->facebook_link)
                                            ->placeholder(__('labels.teacher.facebook_link')) }}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{ html()->label(__('labels.teacher.twitter_link'))->class('col-md-2 form-control-label')->for('twitter_link') }}

                        <div class="col-md-10">
                            {{ html()->text('twitter_link')
                                            ->class('form-control')
                                            ->value(@$teacherProfile->twitter_link)
                                            ->placeholder(__('labels.teacher.twitter_link')) }}

                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{ html()->label(__('labels.teacher.linkedin_link'))->class('col-md-2 form-control-label')->for('linkedin_link') }}

                        <div class="col-md-10">
                            {{ html()->text('linkedin_link')
                                            ->class('form-control')
                                            ->value(@$teacherProfile->linkedin_link)
                                            ->placeholder(__('labels.teacher.linkedin_link')) }}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{ html()->label(__('labels.teacher.payment_details'))->class('col-md-2 form-control-label')->for('payment_details') }}
                        <div class="col-md-10">
                            <select class="form-control" name="payment_method" id="payment_method" required>
                                <option value="bank" {{ @$teacherProfile->payment_method == 'bank'?'selected':'' }}>{{ trans('labels.teacher.bank') }}</option>
                                <option value="paypal" {{ @$teacherProfile->payment_method == 'paypal'?'selected':'' }}>{{ trans('labels.teacher.paypal') }}</option>
                            </select>
                        </div>

                    </div>

                    <div class="bank_details" style="display:{{ @$teacher->teacherProfile->payment_method == 'bank'?'':'none' }}">
                        <div class="form-group row">
                            {{ html()->label(__('labels.teacher.bank_details.name'))->class('col-md-2 form-control-label')->for('bank_name') }}
                            <div class="col-md-10">
                                {{ html()->text('bank_name')
                                        ->class('form-control')
                                        ->value(@$payment_details->bank_name)
                                        ->placeholder(__('labels.teacher.bank_details.name')) }}
                            </div><!--col-->
                        </div>

                        <div class="form-group row">
                            {{ html()->label(__('labels.teacher.bank_details.ifsc_code'))->class('col-md-2 form-control-label')->for('ifsc_code') }}
                            <div class="col-md-10">
                                {{ html()->text('ifsc_code')
                                        ->class('form-control')
                                        ->value(@$payment_details->ifsc_code)
                                        ->placeholder(__('labels.teacher.bank_details.ifsc_code')) }}
                            </div><!--col-->
                        </div>

                        <div class="form-group row">
                            {{ html()->label(__('labels.teacher.bank_details.account'))->class('col-md-2 form-control-label')->for('account_number') }}
                            <div class="col-md-10">
                                {{ html()->text('account_number')
                                        ->class('form-control')
                                        ->value(@$payment_details->account_number)
                                        ->placeholder(__('labels.teacher.bank_details.account')) }}
                            </div><!--col-->
                        </div>

                        <div class="form-group row">
                            {{ html()->label(__('labels.teacher.bank_details.holder_name'))->class('col-md-2 form-control-label')->for('account_name') }}
                            <div class="col-md-10">
                                {{ html()->text('account_name')
                                        ->class('form-control')
                                        ->value(@$payment_details->account_name)
                                        ->placeholder(__('labels.teacher.bank_details.holder_name')) }}
                            </div><!--col-->
                        </div>
                    </div>

                    <div class="paypal_details" style="display:{{ @$teacher->teacherProfile->payment_method == 'paypal'?'':'none' }}">
                        <div class="form-group row">
                            {{ html()->label(__('labels.teacher.paypal_email'))->class('col-md-2 form-control-label')->for('paypal_email') }}
                            <div class="col-md-10">
                                {{ html()->text('paypal_email')
                                        ->class('form-control')
                                        ->value(@$payment_details->paypal_email)
                                        ->placeholder(__('labels.teacher.paypal_email')) }}
                            </div><!--col-->
                        </div>
                    </div>



                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.teachers.fields.status'))->class('col-md-2 form-control-label')->for('active') }}
                        <div class="col-md-10">
                            {{ html()->label(html()->checkbox('')->name('active')
                                        ->checked(($teacher->active == 1) ? true : false)->class('switch-input')->value(($teacher->active == 1) ? 1 : 0)

                                    . '<span class="switch-label"></span><span class="switch-handle"></span>')
                                ->class('switch switch-lg switch-3d switch-primary')
                            }}
                        </div>

                    </div>
{{--  --}}
<div class="form-group row">
{{--    {{ html()->label('Abilities')->class('col-md-2 form-control-label') }}--}}

    <div class="table-responsive col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>@lang('labels.backend.access.users.table.roles')</th>
{{--                    <th>@lang('labels.backend.access.users.table.permissions')</th>--}}
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="display: flex;flex-direction: row;flex-wrap: wrap;justify-content: space-evenly;">
                        @if($roles->count())
                            @foreach($roles as $role)
                                <div class="card card-perm col-md-5" style="height: fit-content; padding:0">
                                    <div class="card-header">
                                        <div class="checkbox d-flex align-items-center" style="width:fit-content">
                                            {{ html()->label(
                                                    html()->checkbox('roles[]', in_array($role->name, $userRoles), $role->name)
                                                        ->class('switch-input')
                                                        ->id('role-'.$role->id)
                                                    . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                ->class('switch switch-label switch-pill switch-primary mr-2')
                                                ->for('role-'.$role->id) }}
                                            {{ html()->label(ucwords($role->name))->for('role-'.$role->id) }}
                                        </div>
                                    </div>
                                    <div class="card-body" style="display:flex; flex-flow: wrap">
                                        @if($role->id != 1)
                                            @if($role->permissions->count())
                                                @foreach($role->permissions as $permission)
                                                    <div style="width: fit-content;" class="col-sm-6">
                                                        <i class="fas fa-dot-circle"></i>
                                                        {{ ucwords($permission->name) }}
                                                    </div>
                                                @endforeach
                                            @else
                                                @lang('labels.general.none')
                                            @endif
                                        @else
                                            @lang('labels.backend.access.users.all_permissions')
                                        @endif
                                    </div>
                                </div><!--card-->
                            @endforeach
                        @endif

                        @if($permissions->count())
                            <div class="card card-perm col-md-5" style="height: fit-content; padding:0">
                                <div class="card-header">
                                    <div class="checkbox d-flex align-items-center" style=" width: fit-content">
                                        <label for="role-2">@lang('labels.backend.access.users.table.other_permissions')</label>
                                    </div>
                                </div>
                                <div class="card-body" style="max-height: 50vh; overflow-y: scroll;">
                                    @foreach($permissions as $permission)
                                        <div style="direction: ltr;display: flex; flex-direction: row;
                                        justify-content: flex-start; align-items: center;">
                                            {{ html()->label(ucwords($permission->name))->for('permission-'.$permission->id) }}
                                            {{ html()->label(
                                          html()->checkbox('permissions[]', in_array($permission->name, $userPermissions), $permission->name)
                                                  ->class('switch-input')
                                                  ->id('permission-'.$permission->id)
                                              . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                          ->class('switch switch-label switch-pill switch-primary mr-2')
                                      ->for('permission-'.$permission->id) }}
                                        </div>
                                    @endforeach
                                </div>
                            </div><!--card-->
                        @endif

                    </td>
                </tr>
            </tbody>
        </table>
    </div><!--col-->
</div><!--form-group-->
{{--  --}}
                    <div class="form-group row justify-content-center">
                        <div class="col-4">
                            {{ form_cancel(route('admin.teachers.index'), __('buttons.general.cancel')) }}
                            {{ form_submit(__('buttons.general.crud.update')) }}
                        </div>
                    </div><!--col-->
                </div>
            </div>
        </div>

    </div>
    {{ html()->closeModelForm() }}
@endsection
@push('after-scripts')
    <script>
        $(document).on('change', '#payment_method', function(){
            if($(this).val() === 'bank'){
                $('.paypal_details').hide();
                $('.bank_details').show();
            }else{
                $('.paypal_details').show();
                $('.bank_details').hide();
            }
        });
        $(document).ready(function() {
            // Initially hide all card bodies
            $('.card-perm .card-body').hide();

            // Add click event listener to all card headers
            $('.card-perm .card-header').click(function() {
                // Toggle visibility of the associated card body
                $(this).next('.card-body').slideToggle();
            });

            // Prevent click event from bubbling up when checkbox is clicked
            $('.card-perm .card-header .checkbox').click(function(event) {
                event.stopPropagation();
            });

    });
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
    </script>
@endpush