@extends('layouts.app')

@section('template_title')
    {{ $company->name ?? 'Show Company' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Company</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('companies.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Razao:</strong>
                            {{ $company->razao }}
                        </div>
                        <div class="form-group">
                            <strong>Fantasia:</strong>
                            {{ $company->fantasia }}
                        </div>
                        <div class="form-group">
                            <strong>Cnpj:</strong>
                            {{ $company->cnpj }}
                        </div>
                        <div class="form-group">
                            <strong>Contato:</strong>
                            {{ $company->contato }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $company->email }}
                        </div>
                        <div class="form-group">
                            <strong>Img:</strong>
                            {{ $company->img }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
