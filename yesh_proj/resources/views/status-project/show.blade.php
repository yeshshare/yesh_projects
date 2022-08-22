@extends('layouts.app')

@section('template_title')
    {{ $statusProject->name ?? 'Show Status Project' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Status Project</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('status-projects.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Company Id:</strong>
                            {{ $statusProject->company_id }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $statusProject->description }}
                        </div>
                        <div class="form-group">
                            <strong>Employee Id:</strong>
                            {{ $statusProject->employee_id }}
                        </div>
                        <div class="form-group">
                            <strong>Project Id:</strong>
                            {{ $statusProject->project_id }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $statusProject->status }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
