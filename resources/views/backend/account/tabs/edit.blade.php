<style>
    .name-en{
        display: contents;
    }
</style>
{{ html()->modelForm($logged_in_user, 'PATCH', route('admin.profile.update'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
<div class="row">
    <div class="col">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.avatar'))->for('avatar') }}

            <div>
                <input class="user-avatar" type="radio" name="avatar_type"
                       value="gravatar" {{ @$logged_in_user->avatar_type == 'gravatar' ? 'checked' : '' }} /> <span class="user-avatar-span">{{__('validation.attributes.frontend.gravatar')}}</span>
                &nbsp;&nbsp;
                <input  class="user-avatar" type="radio" name="avatar_type"
                       value="storage" {{ @$logged_in_user->avatar_type == 'storage' ? 'checked' : '' }} /> <span class="user-avatar-span">{{__('validation.attributes.frontend.upload')}}</span>
@if($logged_in_user)
                @foreach(@$logged_in_user->providers as $provider)
                    @if(strlen($provider->avatar))
                        <input type="radio" name="avatar_type"
                               value="{{ $provider->provider }}" {{ @$logged_in_user->avatar_type == $provider->provider ? 'checked' : '' }} /> {{ ucfirst($provider->provider) }}
                    @endif
                @endforeach
                @endif
            </div>
        </div><!--form-group-->

        <div class="form-group " id="avatar_location"  style="display: none">
            {{ html()->file('avatar_location')->class('form-control') }}
        </div><!--form-group-->

    </div><!--col-->
</div><!--row-->


<div class="row">
    <div class="col">
       
@include('backend.account.partials.country-dropdown')
       
    </div>
</div>
<div class="row">
    <div class="col">
    {{ html()->label(__('validation.attributes.backend.access.users.name_en'))->class('col-md-2 form-control-label name-en')->for('first_name') }}

    <div class="form-group row">
                   
                        <div class="col-md-3">
                            {{ html()->text('first_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.first_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                        <div class="col-md-3">
                                {{ html()->text('last_name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.last_name'))
                                    ->attribute('maxlength', 191)
                                    ->attribute('minlength', 2)
                                    ->required() }}
                            </div>
                            <div class="col-md-3">
                                {{ html()->text('third_name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.third_name'))
                                    ->attribute('maxlength', 191)
                                    ->attribute('minlength', 2)
                                 }}
                            </div>
                            <div class="col-md-3">
                                {{ html()->text('fourth_name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.fourth_name'))
                                    ->attribute('maxlength', 191)
                                    ->attribute('minlength', 2)
                                 }}
                            </div>
                    </div><!--form-group-->

    </div><!--col-->
</div><!--row-->


<div class="row">
    <div class="col">
    <label style="display: block" for="name_ar">{{ __('validation.attributes.frontend.nameAr') }}</label>
        {{-- {{ html()->text('name_ar')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.nameAr')) }} --}}
     
    <div class="form-group row">
         @php
          $nameArArr=$logged_in_user?explode(' ',$logged_in_user->name_ar):[];
        
       @endphp
                               <div class="col-md-3">
        <!-- <input type="text" required name="name_ar[]"  value="{{@$nameArArr[0]}}" id="" class="form-control mb-0 name-ar" placeholder="الاسم الاول"> -->
                                   {{ html()->text('name_ar')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.last_name'))
                                    ->attribute('maxlength', 191)
                                    ->attribute('minlength', 2)
                                    ->required() }}
                             </div>
        <!-- ************** -->
                          <div class="col-md-3">
                                {{ html()->text('sec_name_ar')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.last_name'))
                                    ->attribute('maxlength', 191)
                                    ->attribute('minlength', 2)
                                    ->required() }}
                            </div>
                            <div class="col-md-3">
                                {{ html()->text('third_name_ar')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.third_name'))
                                    ->attribute('maxlength', 191)
                                    ->attribute('minlength', 2)
                                 }}
                            </div>
                            <div class="col-md-3">
                                {{ html()->text('fourth_name_ar')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.fourth_name'))
                                    ->attribute('maxlength', 191)
                                    ->attribute('minlength', 2)
                                 }}
                            </div>
<!-- ************ -->
        <span id="name-ar-error" class="text-danger"></span>
    </div><!--form-group-->
    </div><!--col-->
</div><!--row-->
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">{{ __('validation.attributes.frontend.nationality') }}</label>
            {{-- {{ html()->text('nationality')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.nationality'))->attribute('maxlength', 14)->attribute('id', 'nationality') }} --}}
            <input type="text" name="nationality" value="{{auth()->user()->nationality}}" class="form-control mb-0 nationality" placeholder="{{__('validation.attributes.frontend.nationality')}}" id="nationality">
       
            <span id="nationality-error" class="text-danger"></span>
        </div><!--form-group-->
        </div><!--col-->
    <div class="col-md-4">
    <div class="form-group">
        <label style="display: none"  id='IdTitle'for="name">{{ __('validation.attributes.frontend.national_id_number') }}</label>
        <label style="display: none" id='ResidencyTitle'for="name">{{ __('validation.attributes.frontend.residency_number') }}</label>
        <label  id='globalTitle'for="name">{{ __('validation.attributes.frontend.national_id_number').'/'.__('validation.attributes.frontend.residency_number') }}</label>
        {{-- attribute('maxlength', 10) --}}
        {{ html()->text('national_id_number')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.national_id_number').'/'.__('validation.attributes.frontend.residency_number'))->attribute('required',true)->attribute('id','national_id_number_val') }}
        <span id="national-id-number-error" class="text-danger"></span>
    </div><!--form-group-->
    </div><!--col-->
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">{{ __('validation.attributes.frontend.passport-num') }}</label>
            {{ html()->text('passport_number')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.passport-num'))->attribute('maxlength', 15) }}
            <span id="passport-number-error" class="text-danger"></span>
        </div><!--form-group-->
        </div><!--col-->
       
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">{{ __('validation.attributes.frontend.educational_qualification') }}</label>
                    {{ html()->text('educational_qualification')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.educational_qualification'))->attribute('maxlength', 10) }}
                    <span id="educational-qualification-error" class="text-danger"></span>
                </div><!--form-group-->
                </div><!--col-->
                <div class="col-md-6">
                    <div class="form-group">
                        {{ html()->label(__('labels.backend.general_settings.user_registration_settings.fields.gender'))->for('gender') }}
                        <div class="">
                            <label class="radio-inline mr-3 mb-0">
                                <input type="radio" name="gender" value="male" {{ $logged_in_user->gender == 'male'?'checked':'' }}> {{__('validation.attributes.frontend.male')}}
                            </label>
                            <label class="radio-inline mr-3 mb-0">
                                <input type="radio" name="gender" value="female" {{ $logged_in_user->gender == 'female'?'checked':'' }}> {{__('validation.attributes.frontend.female')}}
                            </label>
                            <label class="radio-inline mr-3 mb-0">
                                <input type="radio" name="gender" value="other" {{ $logged_in_user->gender == 'other'?'checked':'' }}> {{__('validation.attributes.frontend.other')}}
                            </label>
                        </div>
                    </div>
                </div>
</div><!--row-->

@if($logged_in_user)
@if($logged_in_user->hasRole('teacher'))
    @php
        $teacherProfile = $logged_in_user->teacherProfile?:'';
        $payment_details = $logged_in_user->teacherProfile?json_decode($logged_in_user->teacherProfile->payment_details):optional();
    @endphp
  
    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('labels.teacher.facebook_link'))->for('facebook_link') }}

                {{ html()->text('facebook_link')
                    ->class('form-control')
                    ->value($teacherProfile->facebook_link)
                    ->placeholder(__('labels.teacher.facebook_link'))
                }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('labels.teacher.twitter_link'))->for('twitter_link') }}

                {{ html()->text('twitter_link')
                    ->class('form-control')
                    ->value($teacherProfile->twitter_link)
                    ->placeholder(__('labels.teacher.twitter_link'))
                }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('labels.teacher.twitter_link'))->for('linkedin_link') }}

                {{ html()->text('linkedin_link')
                    ->class('form-control')
                    ->value($teacherProfile->linkedin_link)
                    ->placeholder(__('labels.teacher.linkedin_link'))
                }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('labels.teacher.payment_details'))->for('payment_details') }}
                <select class="form-control" name="payment_method" id="payment_method" required>
                    <option value="bank" {{ $teacherProfile->payment_method == 'bank'?'selected':'' }}>{{ trans('labels.teacher.bank') }}</option>
                    <option value="paypal" {{ $teacherProfile->payment_method == 'paypal'?'selected':'' }}>{{ trans('labels.teacher.paypal') }}</option>
                </select>
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
    <div class="bank_details" style="display:{{ $logged_in_user->teacherProfile->payment_method == 'bank'?'':'none' }}">

        <div class="row">
            <div class="col">
                <div class="form-group">
                    {{ html()->label(__('labels.teacher.bank_details.name'))->for('bank_name') }}

                    {{ html()->text('bank_name')
                        ->class('form-control')
                        ->value($payment_details?$payment_details->bank_name:'')
                        ->placeholder(__('labels.teacher.bank_details.name'))
                    }}
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->

        <div class="row">
            <div class="col">
                <div class="form-group">
                    {{ html()->label(__('labels.teacher.bank_details.ifsc_code'))->for('ifsc_code') }}

                    {{ html()->text('ifsc_code')
                        ->class('form-control')
                        ->value($payment_details?$payment_details->ifsc_code:'')
                        ->placeholder(__('labels.teacher.bank_details.ifsc_code'))
                    }}
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->

        <div class="row">
            <div class="col">
                <div class="form-group">
                    {{ html()->label(__('labels.teacher.bank_details.account'))->for('account_number') }}

                    {{ html()->text('account_number')
                        ->class('form-control')
                        ->value($payment_details?$payment_details->account_number:'')
                        ->placeholder(__('labels.teacher.bank_details.account'))
                    }}
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->

        <div class="row">
            <div class="col">
                <div class="form-group">
                    {{ html()->label(__('labels.teacher.bank_details.holder_name'))->for('account_name') }}

                    {{ html()->text('account_name')
                        ->class('form-control')
                        ->value($payment_details?$payment_details->account_name:'')
                        ->placeholder(__('labels.teacher.bank_details.holder_name'))
                    }}
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->

    </div>

    <div class="paypal_details" style="display:{{ $logged_in_user->teacherProfile->payment_method == 'paypal'?'':'none' }}">

        <div class="row">
            <div class="col">
                <div class="form-group">
                    {{ html()->label(__('labels.teacher.paypal_email'))->for('paypal_email') }}

                    {{ html()->text('paypal_email')
                        ->class('form-control')
                        ->value($payment_details?$payment_details->paypal_email:'')
                        ->placeholder(__('labels.teacher.paypal_email'))
                    }}
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->

    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('labels.teacher.description'))->for('description') }}

                {{ html()->textarea('description')
                    ->class('form-control')
                    ->value($teacherProfile->description)
                    ->placeholder(__('labels.teacher.description'))
                }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

@endif
@if ($logged_in_user->canChangeEmail())
    <div class="row">
        <div class="col">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> @lang('strings.frontend.user.change_email_notice')
            </div>

            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                {{ html()->email('email')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.email'))
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
@endif
@endif
@if(config('registration_fields') != NULL)
    @php
        $fields = json_decode(config('registration_fields'));
        $inputs = ['text','number','date'];
    @endphp

@if($logged_in_user)
    @foreach($fields as $item)
        <div class="row">
            <div class="col">
                <div class="form-group">
                    @if(in_array($item->type,$inputs))
                        {{ html()->label(__('labels.backend.general_settings.user_registration_settings.fields.'.$item->name))->for('last_name') }}

                        <input type="{{$item->type}}" class="form-control mb-0" value="{{$logged_in_user[$item->name]}}"
                               name="{{$item->name}}" @if($item->name!='phone')id="{{$item->name}}" @endif @if($item->name=='phone')step="any" required @endif
                              >
                    @elseif($item->type == 'gender')
                        <label class="radio-inline mr-3 mb-0">
                            <input type="radio" @if($logged_in_user[$item->name] == 'male') checked
                                   @endif name="{{$item->name}}"
                                   value="male"> {{__('validation.attributes.frontend.male')}}
                        </label>
                        <label class="radio-inline mr-3 mb-0">
                            <input type="radio" @if($logged_in_user[$item->name] == 'female') checked
                                   @endif  name="{{$item->name}}"
                                   value="female"> {{__('validation.attributes.frontend.female')}}
                        </label>
                        <label class="radio-inline mr-3 mb-0">
                            <input type="radio" @if($logged_in_user[$item->name] == 'other') checked
                                   @endif  name="{{$item->name}}"
                                   value="other"> {{__('validation.attributes.frontend.other')}}
                        </label>
                    @elseif($item->type == 'textarea')
                        <textarea name="{{$item->name}}"
                                  placeholder="{{__('labels.backend.general_settings.user_registration_settings.fields.'.$item->name)}}"
                                  class="form-control mb-0">{{$logged_in_user[$item->name]}}</textarea>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
@endif
@endif
<div class="row">
    <div class="col">
        <div class="form-group mb-0 clearfix">
            {{ form_submit(__('labels.general.buttons.update')) }}
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->
{{ html()->closeModelForm() }}

@push('after-scripts')
    <script>
        $(function () {
            var avatar_location = $("#avatar_location");

            if ($('input[name=avatar_type]:checked').val() === 'storage') {
                avatar_location.show();
            } else {
                avatar_location.hide();
            }

            $('input[name=avatar_type]').change(function () {
                if ($(this).val() === 'storage') {
                    avatar_location.show();
                } else {
                    avatar_location.hide();
                }
            });
        });
        $(document).on('change', '#payment_method', function(){
            if($(this).val() === 'bank'){
                $('.paypal_details').hide();
                $('.bank_details').show();
            }else{
                $('.paypal_details').show();
                $('.bank_details').hide();
            }
        });
    </script>


<script>
    $country=document.getElementById('countrySelection');
    $nationality=document.getElementById('nationality');
    $IdTitle=document.getElementById('IdTitle');
    $ResidencyTitle=document.getElementById('ResidencyTitle');
    $globalTitle=document.getElementById('globalTitle');
    $national_id_number_val=document.getElementById('national_id_number_val');
    
$('#countrySelection').on('change',function(e){
   $countryValue=e.target.value;
   if($countryValue=='السعودية'){
        if($nationality.value.toLowerCase()=='saudia'||$nationality.value.includes('سعود')){
        $ResidencyTitle.style.display='none';
        $IdTitle.style.display='inline-block';
        $globalTitle.style.display='none';
       
        }
        else{
            $ResidencyTitle.style.display='inline-block';
        $IdTitle.style.display='none';
        $globalTitle.style.display='none';

        }
   }
   else{
    $ResidencyTitle.style.display='none';
        $IdTitle.style.display='inline-block';
        $globalTitle.style.display='none';
   }
        $national_id_number_val.setAttribute('placeholder', '')

})
$('#nationality').on('change',function(e){
   $countryValue=$country.value;
   console.log("dd");
   if($countryValue=='السعودية'){
    if($nationality.value.toLowerCase()=='saudia'||$nationality.value.includes('سعود')){

        $ResidencyTitle.style.display='none';
        $IdTitle.style.display='inline-block';
        $globalTitle.style.display='none';
       
        }
        else{
            $ResidencyTitle.style.display='inline-block';
        $IdTitle.style.display='none';
        $globalTitle.style.display='none';

        }
   }
   else{
    $ResidencyTitle.style.display='none';
        $IdTitle.style.display='inline-block';
        $globalTitle.style.display='none';
   }
        $national_id_number_val.setAttribute('placeholder', '')

})


</script>                       


@endpush
