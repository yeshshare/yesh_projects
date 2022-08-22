<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">            
            {{ Form::text('id',$status-project->id, ['hidden' => 'hidden', 'class' => 'form-control' , 'value' => '0','id' => 'id']) }}
            {!! $errors->first('id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        
        <div class="form-group">
            {{ Form::label('company_id') }}
            {{ Form::text('company_id', $statusProject->company_id, ['class' => 'form-control' . ($errors->has('company_id') ? ' is-invalid' : ''), 'placeholder' => 'Company Id', 'required' => 'required']) }}
            {!! $errors->first('company_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $statusProject->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description', 'required' => 'required']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('employee_id') }}
            {{ Form::text('employee_id', $statusProject->employee_id, ['class' => 'form-control' . ($errors->has('employee_id') ? ' is-invalid' : ''), 'placeholder' => 'Employee Id', 'required' => 'required']) }}
            {!! $errors->first('employee_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('project_id') }}
            {{ Form::text('project_id', $statusProject->project_id, ['class' => 'form-control' . ($errors->has('project_id') ? ' is-invalid' : ''), 'placeholder' => 'Project Id', 'required' => 'required']) }}
            {!! $errors->first('project_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $statusProject->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status', 'required' => 'required']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button id="form_submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>