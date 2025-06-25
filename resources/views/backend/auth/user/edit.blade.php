@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.edit'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection
@push('after-styles')
    <style>
        /* .iti {
         position: unset;
        display: unset;
        } */
        /* .iti {
        position: unset;
       display: unset;
       } */
        .countrySelection, .gds-cr-one {
            /*max-width: 50%;*/
            display: flex;
        }
    </style>
@endpush
@section('content')
    {{ html()->modelForm($user, 'PATCH', route('admin.auth.user.update', $user->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body" id="editUser">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.users.management')
                        <small class="text-muted">@lang('labels.backend.access.users.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.clients.fields.name_ar'))->class('col-md-2
                        form-control-label')->for('first_name') }}

                        <div class="col-md-2">
                            {{ html()->text('name_ar')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.first_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                        <div class="col-md-2">
                            {{ html()->text('sec_name_ar')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.last_name'))
                                ->attribute('maxlength', 191)
                                ->attribute('minlength', 2)
                                ->required() }}
                        </div>
                        <div class="col-md-2">
                            {{ html()->text('third_name_ar')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.third_name'))
                                ->attribute('maxlength', 191)
                                ->attribute('minlength', 2)
                                 }}
                        </div>
                        <div class="col-md-2">
                            {{ html()->text('fourth_name_ar')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.fourth_name'))
                                ->attribute('maxlength', 191)
                                ->attribute('minlength', 2)
                                 }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.clients.fields.name_en'))->class('col-md-2
                        form-control-label')->for('first_name') }}

                        <div class="col-md-2">
                            {{ html()->text('first_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.first_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                        <div class="col-md-2">
                            {{ html()->text('last_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.last_name'))
                                ->attribute('maxlength', 191)
                                ->attribute('minlength', 2)
                                ->required() }}
                        </div>
                        <div class="col-md-2">
                            {{ html()->text('third_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.third_name'))
                                ->attribute('maxlength', 191)
                                ->attribute('minlength', 2)
                                 }}
                        </div>
                        <div class="col-md-2">
                            {{ html()->text('fourth_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.fourth_name'))
                                ->attribute('maxlength', 191)
                                ->attribute('minlength', 2)
                                 }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.frontend.binary_name'))->for('is_binary_name')->class('col-md-2 form-control-label') }}

                        <div class="col-md-10">

                            <label class="radio-inline mr-3 mb-0">
                                <input type="checkbox" name="is_binary_name" data-id="{{$user->id}}"
                                       @if($user->is_binary_name=='1') checked @endif id="is_binary_name">

                            </label>
                        </div>
                    </div>
                    <div class="form-group row">

                        {{ html()->label(__('labels.backend.general_settings.user_registration_settings.fields.gender'))->for('gender')->class('col-md-2 form-control-label') }}
                        <div class="col-md-10">
                            <label class="radio-inline mr-3 mb-0">
                                <input type="radio" name="gender"
                                       value="male" {{ $user->gender == 'male'?'checked':'' }}> {{__('validation.attributes.frontend.male')}}
                            </label>
                            <label class="radio-inline mr-3 mb-0">
                                <input type="radio" name="gender"
                                       value="female" {{ $user->gender == 'female'?'checked':'' }}> {{__('validation.attributes.frontend.female')}}
                            </label>
                            <label class="radio-inline mr-3 mb-0">
                                <input type="radio" name="gender"
                                       value="other" {{ $user->gender == 'other'?'checked':'' }}> {{__('validation.attributes.frontend.other')}}
                            </label>
                        </div>
                    </div>


                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.email'))->class('col-md-2 form-control-label')->for('email') }}

                        <div class="col-md-10">
                            {{ html()->email('email')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.email'))
                                ->attributes(['maxlength'=> 191,'readonly'=>true])
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.job'))->class('col-md-2 form-control-label')->for('job') }}

                        <div class="col-md-10">
                            {{ html()->text('job')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.job'))
                                ->attributes(['maxlength'=> 191])
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        @include('backend.auth.user.includes.country-dropdown')
                    </div>
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.frontend.national_id_number'))->class('col-md-2 form-control-label')->for('email') }}

                        <div class="col-md-10">


                            {{ html()->text('national_id_number')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.national_id_number'))->attribute('maxlength', 10) }}
                            <span id="national-id-number-error" class="text-danger"></span>

                        </div><!--col-->
                    </div><!--row-->
                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.teachers.fields.phone'))->class('col-md-2 form-control-label')->for('phone') }}

                        <div class="col-md-10">

                            <input class="form-control" name="phone" id="phone" type="tel"
                                   placeholder="@lang('labels.frontend.contact.phone_number')" value="{{ $user->phone }}">
                            @if($errors->has('phone'))
                                <span class="help-block text-danger">{{$errors->first('phone')}}</span>
                            @endif
                        </div>
                    </div>
                    {{-- roles --}}
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
                    {{-- roles --}}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->closeModelForm() }}


    @push('after-scripts')
        <script>
            $(document).on('click', '#is_binary_name', function (e) {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.users.updateBinaryFlag') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                    },
                }).done(function () {
                    var table = $('#editUser')
                    table.ajax.reload();
                });
            })

        </script>
        <script>
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
@endsection
