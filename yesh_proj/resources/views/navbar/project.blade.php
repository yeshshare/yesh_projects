@if(Request::route()->getActionName() == 'App\Http\Controllers\ProjectController@show')
<navbar.project
    :project="{{$project}}"
    :user="{{$user}}"
></navbar.project>
@elseif(Request::route()->getActionName() == 'App\Http\Controllers\ProjectController@index')
<div class="main-nav-start">
    <h2><span class="icon search-project-color" aria-hidden="true"></span>Projects</h2><br>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
			<button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="false">Overview</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="true">Messages</button>
        </li>            
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="calendar-tab" data-bs-toggle="tab" data-bs-target="#calendar" type="button" role="tab" aria-controls="calendar" aria-selected="false">Calendar</button>
        </li>                        
    </ul>    
</div>
@endif