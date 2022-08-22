@inject('SesionInfo', 'App\Traits\SesionInfo') 
<!-- injeta a classe SesionInfo que implementa o metodo getSesionGuard() do SesionInfoTrait para recuperar o guard do trait  -->   
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">

 <title>{{ config('app.name', 'Laravel') }}</title>

 <!-- Fonts -->
 <link rel="dns-prefetch" href="//fonts.gstatic.com">
 <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('admin/img/svg/logo.svg') }}" type="image/x-icon">
     
  <!-- Custom styles -->
  <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
   <!--css PLUGINS-->
  
   @toastr_css
   @yield('pluginscss')
</head>

<body {{ Session::has('notification') ? 'data-notification' : '' }} 
  data-notification-type='{{ Session::get('alert_type', 'info') }}' 
  data-notification-message='{{ json_encode(Session::get('toastr::notifications')) }}'>
  <div class="layer"></div>
  
  <!-- ! Body -->
  <a class="skip-link sr-only" href="#skip-target">Skip to content</a>
  <div class="page-flex">
   
      <!-- ! Sidebar -->
      @if($SesionInfo->islogged() and mb_strpos(Request::url(),"login") == false) 
        @include('layouts.sidebar')
      @endif
      <div class="main-wrapper">
        <div id="app">
        
        <!-- ! Main nav -->
        @if($SesionInfo->islogged() and mb_strpos(Request::url(),"login") == false) 
          @include('layouts.navbar')
        @endif
        <!-- ! Main -->
        <main class="main users chart-page" id="skip-target">
        @yield('content')
        
        <!-- Modal -->
        @if($SesionInfo->islogged() and mb_strpos(Request::url(),"login") == false)
          @include('modals.users.settings')
        @endif  
        </main>
        @if($SesionInfo->islogged() and mb_strpos(Request::url(),"login") == false)
          <!-- ! Footer -->
          @include('layouts.footer')
        @endif
        </div>
      </div>
   
  </div>
  <!-- Chart library -->
  <script src="{{ asset('admin/plugins/chart.min.js') }}"></script>
  <!-- Icons library -->
  <script src="{{ asset('admin/plugins/feather.min.js') }}"></script>
  <!-- Custom scripts -->
  <script src="{{ asset('admin/js/script.js') }}"></script>
   <!--Js PLUGINS-->
  @jquery
  @toastr_js
  @toastr_render
  <script src="{{ asset('admin/js/popper.js') }}"></script>
  <script src="{{ asset('admin/js/bootstrap.js') }}"></script>
  @yield('pluginsjs')
  <script>
    const chkDarkMode = document.getElementById("darkMode");
    function darkModeISActive(){    
      let isActive = document.body.classList.contains("darkmode");
      console.log(isActive);
      chkDarkMode.checked = isActive;
    }
    chkDarkMode.addEventListener("change",function(){
      let isActive = document.body.classList.contains("darkmode");
      if((this.checked && !isActive) || (!this.checked && isActive)){
        let tempBTN = document.getElementById("switchTheme");
        tempBTN.click();
      }  
    });  
  </script> 
  @if($SesionInfo->islogged() and mb_strpos(Request::url(),"login") == false)
    <script src="{{ asset('js/app.js') }}"></script>
    <script>        
        window.onload = init;
        function init(){
          
          let url = '/employee/list/projects';
          fetch(url)
          .then((resp) => resp.json())
          .then(function(projects) {
            //console.log(projects)
            loadProjectsMenu(projects);
          })
          .catch(function(error) {
              console.log(error);
          });
        }
        function loadProjectsMenu(projects){
          let menuListProjects = document.getElementById('menuListProjects');
          menuListProjects.innerHTML = "";
          document.getElementById('menuListProjects').innerHTML = "";
          /*
          projects.forEach(function(project,index){
            let li = document.createElement("li");
            let a = document.createElement("a")
            a.text = project.title;
            a.href =  `/employee/projects/${project.id}` ;
            li.append(a);
            menuListProjects.append(li);
            document.getElementById('menuListProjects').append(li);          });
          */
        }        
    </script>  
  @endif
</body>

</html>