  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-primary navbar-dark border-bottom-0" >
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
       {{-- @includeIf('welcome.layouts.roleDashboardLinks') --}}

       @auth

        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
             
             <i class="fas fa-user-circle"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            {{-- <span class="dropdown-header">15 Notifications</span> --}}
            {{-- <div class="dropdown-divider"></div> --}}
            
             

            
            {{-- <div class="dropdown-divider"></div> --}}
            <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();" class="dropdown-item">
              <i class="fas fa-sign-out-alt mr-2"></i> {{ __('logout') }}
              {{-- <span class="float-right text-muted text-sm"></span> --}}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
            
        </li>

        @else



        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
             
             <i class="fas fa-user-circle"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

            <a class="dropdown-item" href="{{ route('login') }}"><i class="fas fa-user-circle mr-2"></i> {{ __('login') }}</a>

            <a class="dropdown-item" href="{{ route('register') }}"><i class="fas fa-user-plus mr-2"></i> {{ __('register') }}</a>

          </div>
        </li>


        @endauth
       
    </ul>
  </nav>
  <!-- /.navbar -->