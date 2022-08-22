<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">            
            {{ Form::text('id', $user->id, ['hidden' => 'hidden', 'class' => 'form-control' , 'value' => '0','id' => 'id']) }}
            {!! $errors->first('company_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        
        <div class="form-group">
            {{ Form::label('title') }}
            {{ Form::text('title', $task1->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title', 'required' => 'required']) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $task1->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description', 'required' => 'required']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('deadline') }}
            {{ Form::text('deadline', $task1->deadline, ['class' => 'form-control' . ($errors->has('deadline') ? ' is-invalid' : ''), 'placeholder' => 'Deadline', 'required' => 'required']) }}
            {!! $errors->first('deadline', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('colab') }}
            {{ Form::text('colab', $task1->colab, ['class' => 'form-control' . ($errors->has('colab') ? ' is-invalid' : ''), 'placeholder' => 'Colab', 'required' => 'required']) }}
            {!! $errors->first('colab', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('projetos_id') }}
            {{ Form::text('projetos_id', $task1->projetos_id, ['class' => 'form-control' . ($errors->has('projetos_id') ? ' is-invalid' : ''), 'placeholder' => 'Projetos Id', 'required' => 'required']) }}
            {!! $errors->first('projetos_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('session_id') }}
            {{ Form::text('session_id', $task1->session_id, ['class' => 'form-control' . ($errors->has('session_id') ? ' is-invalid' : ''), 'placeholder' => 'Session Id', 'required' => 'required']) }}
            {!! $errors->first('session_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('session_id1') }}
            {{ Form::text('session_id1', $task1->session_id1, ['class' => 'form-control' . ($errors->has('session_id1') ? ' is-invalid' : ''), 'placeholder' => 'Session Id1', 'required' => 'required']) }}
            {!! $errors->first('session_id1', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button id="form_submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>