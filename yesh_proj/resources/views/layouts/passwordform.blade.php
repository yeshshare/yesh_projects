<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('old password') }}
            {!! Form::password('password_old', ['placeholder' => 'Password','class' => 'form-control' . ($errors->has('password_old') ? ' is-invalid' : ''), 'placeholder' => 'Password', 'required' => 'required','id' => 'form_password_old'])  !!}
            {!! $errors->first('password_old', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('new password') }}
            {!! Form::password('password', ['placeholder' => 'Password','class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Password', 'required' => 'required','id' => 'form_password'])  !!}
            {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('confirmation password') }}
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Password' . ($errors->has('password_confirmation') ? ' is-invalid' : ''), 'placeholder' => 'Password', 'required' => 'required'   ]) !!}
            {!! $errors->first('password_confirmation', '<div class="invalid-feedback">:message</div>') !!}
        </div>        
    </div>
    <div class="box-footer mt20">
        <button id="form_password_submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>

    