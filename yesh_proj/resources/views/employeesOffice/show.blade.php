@extends('layouts.app')

@section('template_title')
    {{ $employeesOffice->name ?? 'Show Employees Office' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Employees Office</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('employeesOffices.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Company Id:</strong>
                            {{ $employeesOffice->company_id }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $employeesOffice->name }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $employeesOffice->description }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
