<div class="box box-info padding-1">
    <div class="box-body">
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
            {{ Form::text('id',$employeesBu->id, ['hidden' => 'hidden', 'class' => 'form-control' , 'value' => '0','id' => 'id']) }}
            {!! $errors->first('id', '<div class="invalid-feedback">:message</div>') !!}
        </div>        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $employeesBu->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name', 'required' => 'required']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $employeesBu->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
       
    </div>
    <div class="box-footer mt20">
        <button id="form_submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>