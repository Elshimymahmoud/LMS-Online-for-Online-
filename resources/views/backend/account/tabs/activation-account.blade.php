{{ html()->form('PATCH', route('admin.account.deactivate'))->class('form-horizontal')->open() }}

<div class="row">
    <div class="col">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.current_password'))->for('current_password') }}

            {{ html()->password('current_password')
                ->class('form-control')
                ->placeholder(__('validation.attributes.frontend.current_password'))
                ->autofocus()
                ->required() }}
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->
<div class="row">
    <div class="col">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.action'))->for('action') }}

            {{ html()->select('action', [
                    '' => __('validation.attributes.frontend.no_action'),
                    'is_activate' => __('validation.attributes.frontend.Disable Account'),
                    'delete' => __('validation.attributes.frontend.Delete Account')
                ])
                ->class('form-control') }}
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->


<div class="row">
    <div class="col">
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                {{ html()->checkbox('allow_personal_info', 1)
                    ->class('custom-control-input')
                    ->id('allow_personal_info') }}

                {{ html()->label(__('validation.attributes.frontend.allow_personal_info'))->class('custom-control-label')->for('allow_personal_info') }}
            </div><!--custom-checkbox-->
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->


<div class="row">
    <div class="col">
        <div class="form-group mb-0 clearfix">
            {{ form_submit(__('validation.attributes.frontend.Confirm Action')) }}
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->

{{ html()->form()->close() }}
