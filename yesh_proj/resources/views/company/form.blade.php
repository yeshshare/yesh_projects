<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">            
            {{ Form::text('id',$company->id, ['hidden' => 'hidden', 'class' => 'form-control' , 'value' => '0','id' => 'id']) }}
            {!! $errors->first('id', '<div class="invalid-feedback">:message</div>') !!}
        </div>        
        <div class="form-group">
            {{ Form::label('razao') }}
            {{ Form::text('razao', $company->razao, ['class' => 'form-control' . ($errors->has('razao') ? ' is-invalid' : ''), 'placeholder' => 'Razao', 'required' => 'required']) }}
            {!! $errors->first('razao', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fantasia') }}
            {{ Form::text('fantasia', $company->fantasia, ['class' => 'form-control' . ($errors->has('fantasia') ? ' is-invalid' : ''), 'placeholder' => 'Fantasia', 'required' => 'required']) }}
            {!! $errors->first('fantasia', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cnpj') }}
            {{ Form::text('cnpj', $company->cnpj, ['class' => 'form-control' . ($errors->has('cnpj') ? ' is-invalid' : ''), 'placeholder' => 'Cnpj', 'required' => 'required']) }}
            {!! $errors->first('cnpj', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('contato') }}
            {{ Form::text('contato', $company->contato, ['class' => 'form-control' . ($errors->has('contato') ? ' is-invalid' : ''), 'placeholder' => 'Contato', 'required' => 'required']) }}
            {!! $errors->first('contato', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $company->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email', 'required' => 'required']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('img') }}
            {{ Form::file('img', $company->img, ['accept'=> 'image','class' => 'form-control', 'placeholder' => 'Img' ]) }}
            {!! $errors->first('img', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button id="form_submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
