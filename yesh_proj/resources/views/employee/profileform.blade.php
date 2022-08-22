
<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">            
            {{ Form::text('id',auth()->guard('employee')->user()->id, ['hidden' => 'hidden', 'class' => 'form-control' , 'value' => '0','id' => 'form_id']) }}
            {!! $errors->first('id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        
        <div class="form-group">
            <label for="company_id">Company</label>
            <select name="company_id" id="form_company_id" class="form-control" required>
                <option value="" {{auth()->guard('employee')->user()->company_id == 0 ? 'Selected': '' }} disabled >
                    Choose a company
                </option>
            @foreach ($companiesList as $key => $company)
                <option value="{{$company->id}}" {{auth()->guard('employee')->user()->company_id == $company->id ? 'Selected' : '' }} >
                    {{$company->id}} - {{$company->fantasia}} 
                </option>            
            @endforeach
            </select>    
        </div>    
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', auth()->guard('employee')->user()->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name', 'required' => 'required','id' => 'form_name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', auth()->guard('employee')->user()->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email', 'required' => 'required','id' => 'form_emai']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('telefone') }}
            {{ Form::text('telefone', auth()->guard('employee')->user()->telefone, ['class' => 'form-control' . ($errors->has('telefone') ? ' is-invalid' : ''), 'placeholder' => 'Telefone', 'required' => 'required','id' => 'form_telefone']) }}
            {!! $errors->first('telefone', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('vinculo') }}
            {{ Form::text('vinculo', auth()->guard('employee')->user()->vinculo, ['class' => 'form-control' . ($errors->has('vinculo') ? ' is-invalid' : ''), 'placeholder' => 'Vinculo', 'required' => 'required','id' => 'form_vinculo']) }}
            {!! $errors->first('vinculo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('endereco') }}
            {{ Form::text('endereco', auth()->guard('employee')->user()->endereco, ['class' => 'form-control' . ($errors->has('endereco') ? ' is-invalid' : ''), 'placeholder' => 'Endereco', 'required' => 'required','id' => 'form_endereco']) }}
            {!! $errors->first('endereco', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="employees_office_id">Office</label>
            <select name="employees_office_id" id="form_employees_office_id" class="form-control" required>
                <option value=""  disabled  {{auth()->guard('employee')->user()->employees_office_id   == 0 ? 'Selected': '' }} >
                    Choose a Office
                </option>
            @foreach ($offices as $key => $office)
                <option value="{{$office->id}}" {{auth()->guard('employee')->user()->employees_office_id  == $office->id ? 'Selected': '' }} >
                    {{$office->id}} - {{$office->name}} 
                </option>            
            @endforeach
            </select>
        </div>         
        <div class="form-group">
            <label for="employees_bu_id">BU</label>
            <select name="employees_bu_id" id="form_employees_bu_id" class="form-control" required>
                <option value="" {{auth()->guard('employee')->user()->employees_bu_id  == 0 ? 'Selected': '' }} disabled >
                    Choose a BU
                </option>
            @foreach ($bus as $key => $bu)
                <option value="{{$bu->id}}"  {{auth()->guard('employee')->user()->employees_bu_id  == $bu->id ? 'Selected': '' }} >
                    {{$bu->id}} - {{$bu->name}} 
                </option>            
            @endforeach
            </select>
        </div>
        <div class="form-group">
            <div class="row justify-content-center">
                <div class="col-8 nav-user-img">
                    <img id="form_profile_img" src="data:image/jpeg;base64,{{auth()->guard('employee')->user()->img ?? ''}}"></img>
                    <input id="form_profile_file" name="img" value="{{auth()->guard('employee')->user()->img ?? ''}}" type="file" hidden />
                </div>
            </div>
        </div>
        <div class="form-group" hidden >
            <br>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="adm" id="form_adm" value="1" {{auth()->guard('employee')->user()->adm  == 1 ? 'checked': '' }}>
                <label class="form-check-label" for="adm">Administator</label>
            </div>
            <br>
        </div>        
    </div>
    <div class="box-footer mt20">
        <button id="form_profile_submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
<script>
    var form_profile_img = document.getElementById('form_profile_img');
    var form_profile_file = document.getElementById('form_profile_file');
    var form_profile_temp = document.getElementById('form_profile_temp');
    form_profile_img.addEventListener('click',function(){
        form_profile_file.click();
    });
    form_profile_file.addEventListener('change',function(){
        console.log(form_profile_file.files[0]);
     
        var reader = new FileReader();

        reader.onloadend = function() {
            form_profile_img.src = reader.result;
            //form_profile_temp.value= form_profile_img.src
            //console.log(tempimg.value);
            //console.log(preview.src);
        }

        if (form_profile_file.files[0]) {
            reader.readAsDataURL(form_profile_file.files[0]);
        } else {
            preview.src = "";
        }  
    });
</script>   