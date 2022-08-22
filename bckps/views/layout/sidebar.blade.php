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
                <hr>
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
                <hr>
                <li>
                    <a href="{{ route('projects.index') }}"><span class="search-project" aria-hidden="true">
                        </span>Projects
                    </a>
                    <a class="show-cat-btn" href="{{ route('companies.index') }}">All Projects
                        <span class="" aria-hidden="true"></span>&nbsp;
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
                   
                <hr>
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
                    <a class="show-cat-btn" href="##">
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
                <!--
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon image" aria-hidden="true"></span>Media
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="media-01.html">Media-01</a>
                        </li>
                        <li>
                            <a href="media-02.html">Media-02</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon paper" aria-hidden="true"></span>Pages
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="pages.html">All pages</a>
                        </li>
                        <li>
                            <a href="new-page.html">Add new page</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="comments.html">
                        <span class="icon message" aria-hidden="true"></span>
                        Comments
                    </a>
                    <span class="msg-counter">7</span>
                </li>
            </ul>
            <span class="system-menu__title">system</span>
            <ul class="sidebar-body-menu">
                <li>
                    <a href="appearance.html"><span class="icon edit" aria-hidden="true"></span>Appearance</a>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon category" aria-hidden="true"></span>Extentions
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="extention-01.html">Extentions-01</a>
                        </li>
                        <li>
                            <a href="extention-02.html">Extentions-02</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon user-3" aria-hidden="true"></span>Users
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="users-01.html">Users-01</a>
                        </li>
                        <li>
                            <a href="users-02.html">Users-02</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="##"><span class="icon setting" aria-hidden="true"></span>Settings</a>
                </li>
            </ul>
        </div>
    </div>-->
    <div class="sidebar-footer">
        <a href="##" class="sidebar-user">
            <!--<span class="sidebar-user-img">
                <picture><source srcset="./img/avatar/avatar-illustrated-01.webp" type="image/webp"><img src="./img/avatar/avatar-illustrated-01.png" alt="User name"></picture>
            </span>-->
            <div class="sidebar-user-info">
            @if($SesionInfo->islogged())
                <span class="sidebar-user__title">{{ Auth::guard($SesionInfo->getSesionGuard())->user()->name }}</span>    
            @else
                <span class="sidebar-user__title"></span>
            @endif    
                <!--<span class="sidebar-user__subtitle">Support manager</span>-->
            </div>
        </a>
    </div>
</aside>