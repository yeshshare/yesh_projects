@extends('layouts.app')

@section('template_title')
    Create Task1
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Task1</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('task1s.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('task1.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
