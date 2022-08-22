<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">            
            {{ Form::text('id', $user->id, ['hidden' => 'hidden', 'class' => 'form-control' , 'value' => '0','id' => 'id']) }}
            {!! $errors->first('company_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="company_id">Company</label>
            <select name="company_id" class="form-control" required>
                <option value="" {{$currentcompany == 0 ? 'Selected': '' }} disabled >
                    choose a company
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
            {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name', 'required' => 'required']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email', 'required' => 'required']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('img') }}
            {{ Form::file('img', $user->img, ['accept'=> 'image','class' => 'form-control', 'placeholder' => 'Img' ]) }}
            {!! $errors->first('img', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('password') }}
            {!! Form::password('password', ['placeholder' => 'Password','class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Password', 'required' => 'required'])  !!}
            {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
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