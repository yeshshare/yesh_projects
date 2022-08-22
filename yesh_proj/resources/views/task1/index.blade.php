@extends('layouts.app')
@section('pluginscss')
  <!--<link rel="stylesheet" href="{{ asset('admin/css/grid.css') }}">-->
@endsection
@section('pluginsjs')
  <script src="{{ asset('admin/plugins/grid.js') }}"></script>

  @if(is_null(session()->get('toastr::notifications')))
  <script>
    var notificationMessage = 0;
  </script>  
  @else
  <script>
    var notificationMessage = {!!json_encode(session()->get('toastr::notifications')) !!};
  </script>
  @endif
  <script>
    const form = document.getElementById('form');
    const method = document.getElementById('method');
    const form_title = document.getElementById('form_title');
    const form_submit = document.getElementById("form_submit");
    var form_action = form.action;
    var task1s =  {!! json_encode($task1s) !!};
    var task1 =  {!! json_encode($task1) !!};
    var errors =  {!!json_encode(session()->all()) !!};
    try {
      if(errors._old_input._method == "PATCH"){
        form_action_edit(errors._old_input.id);
      }else if(errors._old_input._method == "POST"){
        form_action_new();
      }  
    } catch (error) {
      
    }
    
   
    
    return_errors(notificationMessage);
    
	function return_errors(notificationMessage){
		if(notificationMessage){
			let has_error = false;
			notificationMessage.forEach(function(notification){
			  if(notification.type == "error"){
				has_error = true;
			  }
			});
			if(has_error){
			  var myModal = new bootstrap.Modal(document.getElementById('form_modal'), {})
			  myModal.show();
			}      
		};
	};
    ////task1s = getdata(task1s);
    new gridjs.Grid({
      pagination: true,
      fixedHeader: true,
        language: {
          'search': {
            'placeholder': '🔍 Search...'
          },
          'pagination': {
            'previous': '⬅️',
            'next': '➡️',
            'showing': '😃 showing',
            'results': () => 'records'
          },
          loading: 'Loading ...',
          noRecordsFound: 'no record found',
          error: 'Erro',
          language: 'ptBR',
        },
        
		columns: ['Id',
    'Company',
    'Name',
    'Email',
    'Img',
    'Actions'
  ],
		search: true,
    //data: task1s.data,
    data: task1s.data.map(task1 => [
      
            task1.id,
            task1.copany_id,
            task1.name, 
            task1.email,
            gridjs.html(`<img src="data:image/jpeg;base64,${task1.img}"></img>`),
            gridjs.html(
             `<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                

                            <div class="btn-group" role="group">
                              <button id="btnGroupDrop${task1.id}" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="btnGroupDrop${task1.id}">
                                <li><a class="dropdown-item edit" href="#"  data-bs-toggle="modal" data-bs-target="#form_modal" onclick="form_action_edit('${task1.id}')" >Editar</a></li>
                                <li>
                                    <a class="dropdown-item" method="DELETE" href="" data-bs-toggle="modal" data-bs-target="#form_modal" onclick="form_action_delete('${task1.id}')"       >Excluir</a>
                                </li>                                
                              </ul>
                            </div>
                          </div>
            `)]),
    
    
		className: {
			table: 'posts-table',
			th: 'task1s-table-info',
			input: 'gridjs-search-input',
      footer: 'texto  ',
		}
    }).render(document.getElementById("wrapper"));

    function form_action_new(){
      form_clear();
      form_change_class("btn-danger","btn-primary");
      form_submit.innerText = "Save";
      method.value = 'POST';
      form_title.innerText = "New"; 
      form.action = form_action;
    }
    function form_action_edit(id){
      form_change_class("btn-danger","btn-primary");
      form_submit.innerText = "Save";
      method.value = 'PATCH';
      method.value = 'PATCH';
      form_title.innerText = "Edit";
      form.action  = `${form_action}/${id}`;      
      task1s.data.forEach(function(u){
        if(u.id == id){
          let keys = Object.keys(u);
          keys.forEach(function(key){
            try {
              let element = document.getElementById(key);  
              if(element !== null){
                element.value = eval(`u.${key}`);
              }                 
            } catch (error) {}                 
          });          
        }
      });

    }
    function form_action_delete(id){
      form_change_class("btn-primary","btn-danger");
      form_submit.innerText = "Delete";
      form_title.innerText = "Delete";
      method.value = 'DELETE';
      form.action  = `${form_action}/${id}`;      
      task1s.data.forEach(function(u){
        if(u.id == id){
          let keys = Object.keys(u);
          keys.forEach(function(key){
            try {
              let element = document.getElementById(key);  
              if(element !== null){                
                element.value = eval(`u.${key}`);
                element.readOnly = true;
              }                 
            } catch (error) {}                 
          });          
        }
      });       
    }
    var myModalEl = document.getElementById('form_modal')
    myModalEl.addEventListener('hidden.bs.modal', function (event) {
      //var form = document.getElementById("your_form_id");
        var elements = form.elements;
        for (var i = 0, len = elements.length; i < len; ++i) {
            elements[i].readOnly = false;
        }
    })
    function form_clear(){
      var elements = form.elements;
      for (var i = 0, len = elements.length; i < len; ++i) {
        if(elements[i].name != '_token'){
          if(elements[i].name == "id"){
            elements[i].value = 0;
          }else{
            elements[i].value = "";
          }
        }
      }
    }
    function form_change_class(current_class,new_class){
      try {
        if(form_submit.classList.contains(current_class)){
        form_submit.classList.remove(current_class);        
        }
        if(!form_submit.classList.contains(new_class)){
          form_submit.classList.add(new_class);        
        }        
      } catch (error) {}      
    }
  </script>
@endsection
@section('content')

    <div class="container">
		<div class="row">
			<div class="col-10">
			  <h2 class="main-title">{{ __('Task1') }}</h2>
			</div>
			<div class="col">
			  <div class="float-right" >
				<!--<a href="{{ route('task1s.create') }}" class="btn primary-default-btn btn-primary btn-sm float-right"  
        data-placement="left" data-toggle="modal" data-target="#exampleModal">
				  {{ __('Novo') }}
				</a>-->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form_modal" onclick="form_action_new()" >New </button>
       
			</div>    
			</div>
		</div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
        <div class="row">
          <div class="col-lg-12">
            <div id="wrapper" class="task1s-table table-wrapper"></div> 
          </div>
        </div>       
    </div>   
 
<!-- Modal -->
<div class="modal fade" id="form_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="form_title" class="modal-title" id="exampleModalLabel">New </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @includeif('partials.errors')
        <div class="row">
            <div class="col2">
                <form id="form"  method="POST" action="{{ route('task1s.store') }}"  role="form" enctype="multipart/form-data">
                    @csrf    
                    <input type="hidden" id="method" name="_method" value="POST">
                    @include('task1.form')
                </form>
            </div>
        </div>
      </div>
     
    </div>
  </div>
</div>
@endsection
