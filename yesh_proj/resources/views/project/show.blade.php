
@extends('layouts.app')

@section('template_title')
    {{ $project->description ?? 'Show Project' }}
@endsection

@section('content')
    
    <section class="content container-fluid">
            <task.main
                :project="{{$project }}"
                :user="{{$user}}"
                
            ></task.main>
        </div>    
    </section>
    
@endsection
