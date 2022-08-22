<aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="/" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text">
                    <span class="logo-title">{{env('APP_NAME')}}</span>
                    <span class="logo-subtitle">{{env('APP_NAME')}}</span>
                </div>

            </a>
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
                <span class="icon menu-toggle" aria-hidden="true"></span>
            </button>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a href="{{route($SesionInfo->getSesionGuard() == "web" ? 'home':'home_staff') }}"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                </li>
                <li>
                    <a href="/"><span class="icon time-circle" aria-hidden="true"></span>My tasks</a>
                </li>
                <li>
                    <a href="/"><span class="icon message" aria-hidden="true"></span>Inbox</a>
                </li>
                <li>
                    <a href="/"><span class="icon graph" aria-hidden="true"></span>Reporting</a>
                </li>
            </ul>
            <ul class="sidebar-body-menu">       
                <li>
                    <a href="/"><span class="" aria-hidden="true"></span>Tasks I've created</a>
                </li>
                <li>
                    <a href="/"><span class="" aria-hidden="true"></span>Tasks I've assigned to others</a>
                </li>
                <li>
                    <a href="/"><span class="" aria-hidden="true"></span>Recently completed tasks</a>
                </li>
                <li>
                    <a href="/"><span class="" aria-hidden="true"></span>Messages I've sent</a>
                </li>
                <li>
                    <a href="/"><span class="" aria-hidden="true"></span>Messages I've received</a>
                </li>
            </ul>
            <a href="{{ route('projects.index') }}">
                <span class="search-project" aria-hidden="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <span class="system-menu__title">Projects</span>
            </a>
            <ul class="sidebar-body-menu">
                <li>
                    
                    <a class="show-cat-btn">
                        <span class="" aria-hidden="true"></span>All Projects
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul id="menuListProjects" class="cat-sub-menu">
                        <li>
                            <a href="">Company</a>
                        </li>
                        <li>
                            <a href="">Business unit</a>
                        </li>
                        <li>
                            <a href="">Officie</a>
                        </li>
                    </ul>
                </li> 
            </ul>
            <ul class="sidebar-body-menu">
                <li>
                    <a class="show-cat-btn" href="{{ route('companies.index') }}">
                        <span class="icon company" aria-hidden="true"></span>Company
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="{{ route('companies.index') }}">Company</a>
                        </li>
                        <li>
                            <a href="{{ route('employeesBus.index') }}">Business unit</a>
                        </li>
                        <li>
                            <a href="{{ route('employeesOffices.index') }}">Officie</a>
                        </li>
                    </ul>
                </li>
                @if($SesionInfo->isUserADM())
                <li>
                    <a class="show-cat-btn" href="#">
                        <span class="icon user-3" aria-hidden="true"></span>Users
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        @if($SesionInfo->getSesionGuard() == "web")
                        <li>
                            <a href="{{ route('users.index') }}">Administrators</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('employees.index') }}">Employees</a>
                        </li>
                    </ul>                    
                </li>
                @endif              
            </ul>                        
        </div>
    </div>
    <div class="sidebar-footer">
        <a href="#" class="sidebar-user">
            <div class="sidebar-user-info">
            @if($SesionInfo->islogged())
                <span class="sidebar-user__title">{{ Auth::guard($SesionInfo->getSesionGuard())->user()->name }}</span>    
            @else
                <span class="sidebar-user__title"></span>
            @endif    
            </div>
        </a>
    </div>
</aside>