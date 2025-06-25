    {{-- Form --}}
    {{-- {!! Form::open(['method' => 'POST', 'route' => ['admin.answerEvaluate.store'], 'files' => true,]) !!} --}}
    {!! Form::open(['method' => 'POST', 'files' => true,]) !!}
      
    <div class="row">
        <div class="col-md-6">
            <div class=" form-group">
                {!! Form::label('first_name',trans('labels.backend.teachers.fields.first_name'), ['class' => 'control-label dark-red']) !!}
                {!! Form::text('first_name' ,'',['class' => 'form-control select2','id'=>'first_name', 'required' => false]) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class=" form-group">
                {!! Form::label('last_name',trans('labels.backend.teachers.fields.last_name'), ['class' => 'control-label dark-red']) !!}
                {!! Form::text('last_name','',['class' => 'form-control select2','id'=>'last_name', 'required' => false]) !!}
            </div>
        </div>
      
        <div class="col-md-12">
            <div class=" form-group">
                {!! Form::label('organization',trans('labels.backend.teachers.fields.organization'), ['class' => 'control-label dark-red']) !!}
                {!! Form::text('organization','',['class' => 'form-control select2','id'=>'organization', 'required' => false]) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class=" form-group">
                {!! Form::label('email',trans('labels.backend.teachers.fields.email'), ['class' => 'control-label dark-red']) !!}
                {!! Form::text('email','',['class' => 'form-control select2','id'=>'email', 'required' => false]) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class=" form-group">
                {!! Form::label('phone',trans('labels.backend.teachers.fields.phone'), ['class' => 'control-label dark-red']) !!}
                {!! Form::text('phone','',['class' => 'form-control select2','id'=>'phone', 'required' => false]) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class=" form-group">
                {!! Form::label('program_name',trans('labels.backend.teachers.fields.program_name'), ['class' => 'control-label dark-red']) !!}
                {!! Form::text('program_name','',['class' => 'form-control select2','id'=>'program_name', 'required' => false]) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class=" form-group">
                {!! Form::label('message',trans('labels.backend.teachers.fields.message'), ['class' => 'control-label dark-red']) !!}
                {!! Form::text('message','',['class' => 'form-control select2','id'=>'message', 'required' => false]) !!}
            </div>
        </div>
        
    </div>
    {{-- Form --}}
  
        <div class="form-group row justify-content-center"
            style="margin-right: 5%;">
            <div class="col-4">
                <button class="btn btn-success" style="background-color: ##3bcfcb;"
                    type="submit">{{ __('buttons.general.crud.create') }}</button>
            </div>
        </div>
        <!--col-->
  
        {!! Form::close() !!}