@extends('layouts.app')

@section('template_title')
    {{ $employee->name ?? 'Show Employee' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Employee</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('employees.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Company Id:</strong>
                            {{ $employee->company_id }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $employee->name }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $employee->email }}
                        </div>
                        <div class="form-group">
                            <strong>Telefone:</strong>
                            {{ $employee->telefone }}
                        </div>
                        <div class="form-group">
                            <strong>Vinculo:</strong>
                            {{ $employee->vinculo }}
                        </div>
                        <div class="form-group">
                            <strong>Endereco:</strong>
                            {{ $employee->endereco }}
                        </div>
                        <div class="form-group">
                            <strong>Employees Office Id:</strong>
                            {{ $employee->employees_office_id }}
                        </div>
                        <div class="form-group">
                            <strong>Employees Bu Id:</strong>
                            {{ $employee->employees_bu_id }}
                        </div>
                        <div class="form-group">
                            <strong>Img:</strong>
                            {{ $employee->img }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
