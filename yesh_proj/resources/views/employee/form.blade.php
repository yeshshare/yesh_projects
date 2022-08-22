<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">            
            {{ Form::text('id',$employee->id, ['hidden' => 'hidden', 'class' => 'form-control' , 'value' => '0','id' => 'id']) }}
            {!! $errors->first('id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        
        <div class="form-group">
            <label for="company_id">Company</label>
            <select name="company_id" id="company_id" class="form-control" required>
                <option value="" {{$currentcompany == 0 ? 'Selected': '' }} disabled >
                    Choose a company
                </option>
            @foreach ($companiesList as $key => $company)
                <option value="{{$company->id}}" {{$currentcompany == $company->id ? 'Selected' : '' }} >
                    {{$company->id}} - {{$company->fantasia}} 
                </option>            
            @endforeach
            </select>    
        </div>    
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $employee->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name', 'required' => 'required']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $employee->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email', 'required' => 'required']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('telefone') }}
            {{ Form::text('telefone', $employee->telefone, ['class' => 'form-control' . ($errors->has('telefone') ? ' is-invalid' : ''), 'placeholder' => 'Telefone', 'required' => 'required']) }}
            {!! $errors->first('telefone', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('vinculo') }}
            {{ Form::text('vinculo', $employee->vinculo, ['class' => 'form-control' . ($errors->has('vinculo') ? ' is-invalid' : ''), 'placeholder' => 'Vinculo', 'required' => 'required']) }}
            {!! $errors->first('vinculo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('endereco') }}
            {{ Form::text('endereco', $employee->endereco, ['class' => 'form-control' . ($errors->has('endereco') ? ' is-invalid' : ''), 'placeholder' => 'Endereco', 'required' => 'required']) }}
            {!! $errors->first('endereco', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="employees_office_id">Office</label>
            <select name="employees_office_id" id="employees_office_id" class="form-control" required>
                <option value=""  disabled >
                    Choose a Office
                </option>
            @foreach ($offices as $key => $office)
                <option value="{{$office->id}}" >
                    {{$office->id}} - {{$office->name}} 
                </option>            
            @endforeach
            </select>
        </div>         
        <div class="form-group">
            <label for="employees_bu_id">BU</label>
            <select name="employees_bu_id" id="employees_bu_id" class="form-control" required>
                <option value="" {{$currentcompany == 0 ? 'Selected': '' }} disabled >
                    Choose a BU
                </option>
            @foreach ($bus as $key => $bu)
                <option value="{{$bu->id}}"  >
                    {{$bu->id}} - {{$bu->name}} 
                </option>            
            @endforeach
            </select>
        </div>
        <div class="form-group">
            <br>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="adm" id="adm" value="1">
                <label class="form-check-label" for="adm">Administator</label>
            </div>
            <br>
        </div>   
        <div class="form-group">
            {{ Form::label('img') }}
            {{ Form::file('img', ['value' => $employee->img,'accept'=> 'image','class' => 'form-control', 'placeholder' => 'Img' ]) }}
            {!! $errors->first('img', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('password') }}
            {!! Form::password('password', ['placeholder' => 'Password','class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Password', 'required' => 'required'])  !!}
            {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
            <br>
        </div>
        <div class="form-group">
            {{ Form::label('password') }}
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Password' . ($errors->has('password_confirmation') ? ' is-invalid' : ''), 'placeholder' => 'Password', 'required' => 'required'   ]) !!}
            {!! $errors->first('password_confirmation', '<div class="invalid-feedback">:message</div>') !!}
        </div>     
    </div>
    <div class="box-footer mt20">
        <button id="form_submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>