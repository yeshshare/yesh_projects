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
  <script src="{{ asset('admin/js/commonregister.js') }}"></script>
  <script>
    var employees =  {!! json_encode($employees) !!};
    var employee = {!! json_encode($employee) !!};
    var errors =  {!!json_encode(session()->all()) !!};
    var itens = employees;
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
      columns: ['Id','Company','Name','Email','Telefone','Vinculo','Endereco','Employees_office','Employees_bu','Img','Actions'],
		  search: true,
      data: employees.data.map(employee => [employee.id,employee.company_id,employee.name,employee.email,employee.telefone,employee.vinculo,employee.endereco,employee.employees_office_id,employee.employees_bu_id,gridjs.html(`<img src="data:image/jpeg;base64,${employee.img}" ></img>`),gridjs.html(
                    `<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop${employee.id}" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop${employee.id}">
                                <li><a class="dropdown-item edit" href="#"  data-bs-toggle="modal" data-bs-target="#form_modal" onclick="form_action_edit('${employee.id}')" >Editar</a></li>
                                <li>
                                    <a class="dropdown-item" method="DELETE" href="" data-bs-toggle="modal" data-bs-target="#form_modal" onclick="form_action_delete('${employee.id}')">Excluir</a>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                `)]),
		  className: {
			  table: 'posts-table',
			  th: 'users-table-info',
			  input: 'gridjs-search-input',
        footer: 'texto  ',
		  }
    }).render(document.getElementById("wrapper"));
  </script>
@endsection
@section('content')
    <div class="container">
		<div class="row">
			<div class="col-10">
			  <h2 class="main-title">{{ __('Employee') }}</h2>
			</div>
			<div class="col">
			  <div class="float-right" >
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
            <div id="wrapper" class="users-table table-wrapper"></div> 
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
                    <form id="form"  method="POST" action="{{ route('employees.store') }}"  role="form" enctype="multipart/form-data">
                        @csrf    
                        <input type="hidden" id="method" name="_method" value="POST">
                        @include('employee.form')
                    </form>
                </div>
            </div>
          </div>        
        </div>
      </div>
    </div>
@endsection
