@extends('layouts.app')

@section('template_title')
    {{ $task1->name ?? 'Show Task1' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Task1</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('task1s.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $task1->title }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $task1->description }}
                        </div>
                        <div class="form-group">
                            <strong>Deadline:</strong>
                            {{ $task1->deadline }}
                        </div>
                        <div class="form-group">
                            <strong>Colab:</strong>
                            {{ $task1->colab }}
                        </div>
                        <div class="form-group">
                            <strong>Projetos Id:</strong>
                            {{ $task1->projetos_id }}
                        </div>
                        <div class="form-group">
                            <strong>Session Id:</strong>
                            {{ $task1->session_id }}
                        </div>
                        <div class="form-group">
                            <strong>Session Id1:</strong>
                            {{ $task1->session_id1 }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
