@extends('layouts.app')

@section('content')
@foreach ($usersList as $key => $user)
<input id="userData{{$key}}"  type="hidden" value="{{$user}}">
@endforeach
<input id="qtdUser"   type="hidden" value="{{count($usersList)}}">
@foreach ($projects as $key => $project)
<input id="projectData{{$key}}"  type="hidden" value="{{$project}}">
@endforeach
<input id="qtdProject"   type="hidden" value="{{count($projects)}}">





<div class="container-fliud">
    <div id="app">
        <project.main
          
        ></project.main>
    </div>
</div>



    
@endsection
