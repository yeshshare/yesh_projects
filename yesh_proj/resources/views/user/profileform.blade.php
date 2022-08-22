<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">            
            {{ Form::text('id', auth()->user()->id ?? '', ['hidden' => 'hidden', 'class' => 'form-control' , 'value' => '0','id' => 'form_id']) }}
            {!! $errors->first('id', '<div class="invalid-feedback">:message</div>') ?? "" !!}
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
            {{ Form::text('name', auth()->user()->name ?? '', ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name', 'required' => 'required','id' => 'form_name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') ?? "" !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', auth()->user()->email ?? '', ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email', 'required' => 'required','id' => 'form_email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') ?? "" !!}
        </div>               
        <div class="form-group">
            <div class="row justify-content-center">
                <div class="col-8 nav-user-img">
                    <img id="form_profile_img" src="data:image/jpeg;base64,{{auth()->user()->img ?? ''}}"></img>
                    <input id="form_profile_file" name="img" value="{{auth()->user()->img ?? ''}}" type="file" hidden />
                </div>
            </div>
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