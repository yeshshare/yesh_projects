@extends('layouts.app')

@section('template_title')
    {{ $employeesBu->name ?? 'Show Employees Bu' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Employees Bu</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('employeesBus.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $employeesBu->name }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $employeesBu->description }}
                        </div>
                        <div class="form-group">
                            <strong>Company Id:</strong>
                            {{ $employeesBu->company_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
