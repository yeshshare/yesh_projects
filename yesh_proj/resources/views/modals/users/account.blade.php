<div class="row">
    <div class="col2">
      <form id="form_account"  method="POST" action="{{ route($SesionInfo->getModelName().'s.update',auth()->guard($SesionInfo->getSesionGuard())->user()->id) }}"  role="form" enctype="multipart/form-data">
        @csrf    
        <input type="hidden" id="method_account" name="_method" value="PATCH">
        <input type="hidden" id="origem_account" name="_origem" value="password">
        @include('layouts.passwordform')
      </form>  
    </div>
</div>