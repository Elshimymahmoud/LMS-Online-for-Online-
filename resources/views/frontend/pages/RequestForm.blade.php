    {{-- Form --}}
    {{-- {!! Form::open(['method' => 'POST', 'route' => ['admin.answerEvaluate.store'], 'files' => true,]) !!} --}}
    {!! Form::open(['method' => 'POST', 'files' => true,'route'=>['RequestCourse.store']]) !!}

    <div class="row contract">
        <div class="col-md-6">
            <div class=" form-group">
                {!! Form::label('first_name',trans('labels.backend.teachers.fields.first_name'), ['class' => 'control-label text-white']) !!}
                {!! Form::text('first_name' ,'',['class' => 'form-control select2','id'=>'first_name', 'required' => false]) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class=" form-group">
                {!! Form::label('last_name',trans('labels.backend.teachers.fields.last_name2'), ['class' => 'control-label dark-red text-white']) !!}
                {!! Form::text('second_name','',['class' => 'form-control select2','id'=>'last_name', 'required' => false]) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class=" form-group">
                {!! Form::label('job',trans('labels.backend.teachers.fields.job'), ['class' => 'control-label dark-red text-white']) !!}
                {!! Form::text('job','',['class' => 'form-control select2','id'=>'job', 'required' => false]) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class=" form-group">
                {!! Form::label('company',trans('labels.backend.teachers.fields.company'), ['class' => 'control-label dark-red text-white']) !!}
                {!! Form::text('company','',['class' => 'form-control select2','id'=>'company', 'required' => false]) !!}
            </div>
        </div>

        <!-- <div class="col-md-6">
            <div class=" form-group">
                {!! Form::label('organization',trans('labels.backend.teachers.fields.organization'), ['class' => 'control-label dark-red text-white']) !!}
                {!! Form::text('organization','',['class' => 'form-control select2','id'=>'organization', 'required' => false]) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class=" form-group">
                {!! Form::label('program_name',trans('labels.backend.teachers.fields.program_name'), ['class' => 'control-label dark-red text-white']) !!}
                {!! Form::text('course_name','',['class' => 'form-control select2','id'=>'program_name', 'required' => false]) !!}
            </div>
        </div> -->

        <div class="col-md-6">
            <div class=" form-group">
                {!! Form::label('email',trans('labels.backend.teachers.fields.email'), ['class' => 'control-label dark-red text-white']) !!}
                {!! Form::text('email','',['class' => 'form-control select2','id'=>'email', 'required' => false]) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class=" form-group">
                {!! Form::label('phone',trans('labels.backend.teachers.fields.phone'), ['class' => 'control-label dark-red text-white']) !!}
                {!! Form::text('phone','',['class' => 'form-control select2','id'=>'', 'required' => false]) !!}
            </div>
        </div>

        <div class="col-md-12">
            <!-- <div class=" form-group">
                {!! Form::label('message',trans('labels.backend.teachers.fields.message'), ['class' => 'control-label dark-red text-white']) !!}
                {!! Form::textarea('message','',['class' => 'form-control select2', 'rows' => 3,'id'=>'message', 'required' => false]) !!}
            </div>
        </div> -->

        </div>
        {{-- Form --}}

        <hr>
        <!-- <div class="form-group row justify-content-center row"> -->
            <!-- <div class="col-md-6 contract" style="margin-right: 42%;">
                <button  style="font-size: 11px" class="btn btn-primary btn-md" type="submit">{{ __('buttons.general.crud.orderNow') }}</button>
            </div> -->
            <div class="d-block align-self-center">
                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary">الغاء</button>
                <button style="    color: #fff;
    background-color: #0d6efd;
    border-color: #0d6efd;" type="submit" class="btn btn-primary">ارسال</button>
            </div>
        <!-- </div> -->
        <!--col-->

        {!! Form::close() !!}