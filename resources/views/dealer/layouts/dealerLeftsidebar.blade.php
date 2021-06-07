
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-indigo elevation-2">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link bg-indigo text-center">
      {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> --}}
           <img class="" style="max-width: 80px; max-height:80px" src="{{ asset('img/dhpl.jpg') }}" alt="">
      <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('cp/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>
 --}}
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-compact" data-widget="treeview" role="menu" data-accordion="true">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item has-treeview {{ session('lsbm') == 'dashboard' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{ __('Dashboard') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">


               
              <li class="nav-item ">
                <a href="{{ route('dealer.dashboard', $dealer) }}" class="nav-link {{ session('lsbsm') == 'dashboard' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Dashboard') }}</p>
                </a>
              </li>

 
              <li class="nav-item ">
                <a href="{{ route('dealer.allAgents', $dealer) }}" class="nav-link {{ session('lsbsm') == 'allAgents' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('All Agents') }}</p>
                </a>
              </li>
              
              <li class="nav-item ">
                <a href="{{ route('dealer.allMarkets', $dealer) }}" class="nav-link {{ session('lsbsm') == 'allMarkets' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('All Markets') }}</p>
                </a>
              </li>

              


               

               
            </ul>
          </li>

          {{-- <li class="nav-item has-treeview {{ session('lsbm') == 'lead' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tag"></i>
              <p>
                {{ __('Lead') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item ">
                <a href="{{ route('dealer.allLeads', ['status'=>'pending', 'dealer'=>$dealer]) }}" class="nav-link {{ session('lsbsm') == 'allLeadspending' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Pending Leads') }}</p>
                </a>
              </li>


              <li class="nav-item ">
                <a href="{{ route('dealer.allLeads', ['status'=>'published', 'dealer'=>$dealer]) }}" class="nav-link {{ session('lsbsm') == 'allLeadspublished' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Published Leads') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('dealer.allLeadOrders', ['dealer'=>$dealer, 'status'=>'confirmed']) }}" class="nav-link {{ session('lsbsm') == 'allLeadOrdersconfirmed' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Confirmed Lead Orders') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('dealer.allLeadOrders', ['dealer'=>$dealer, 'status'=>'processing']) }}" class="nav-link {{ session('lsbsm') == 'allLeadOrdersprocessing' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Processing Lead Orders') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('dealer.allLeadOrders', ['dealer'=>$dealer, 'status'=>'ready_to_ship']) }}" class="nav-link {{ session('lsbsm') == 'allLeadOrdersready_to_ship' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Ready to Ship Lead Orders') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('dealer.allLeadOrders', ['dealer'=>$dealer, 'status'=>'shipped']) }}" class="nav-link {{ session('lsbsm') == 'allLeadOrdersshipped' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Shipped Lead Orders') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('dealer.allLeadOrders', ['dealer'=>$dealer, 'status'=>'collected']) }}" class="nav-link {{ session('lsbsm') == 'allLeadOrderscollected' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Collected Lead Orders') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('dealer.allLeadOrders', ['dealer'=>$dealer, 'status'=>'delivered']) }}" class="nav-link {{ session('lsbsm') == 'allLeadOrdersdelivered' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Delivered Lead Orders') }}</p>
                </a>
              </li>

            </ul>
          </li> --}}

          {{-- <li class="nav-item has-treeview {{ session('lsbm') == 'order' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-th"></i>
              <p>
                {{ __('Order') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item ">
                <a href="{{ route('dealer.allOrders', ['status'=>'pending', 'dealer'=>$dealer]) }}" class="nav-link {{ session('lsbsm') == 'allOrderspending' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Pending Orders') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('dealer.allOrders', ['status'=>'confirmed', 'dealer'=>$dealer]) }}" class="nav-link {{ session('lsbsm') == 'allOrdersconfirmed' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Confirmed Orders') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('dealer.allOrders', ['status'=>'processing', 'dealer'=>$dealer]) }}" class="nav-link {{ session('lsbsm') == 'allOrdersprocessing' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Processing Orders') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('dealer.allOrders', ['status'=>'ready_to_ship', 'dealer'=>$dealer]) }}" class="nav-link {{ session('lsbsm') == 'allOrdersready_to_ship' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Ready Orders') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('dealer.allOrders', ['status'=>'shipped', 'dealer'=>$dealer]) }}" class="nav-link {{ session('lsbsm') == 'allOrdersshipped' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Shipped Orders') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('dealer.allOrders', ['status'=>'collected', 'dealer'=>$dealer]) }}" class="nav-link {{ session('lsbsm') == 'allOrderscollected' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Collected Orders') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('dealer.allOrders', ['status'=>'delivered', 'dealer'=>$dealer]) }}" class="nav-link {{ session('lsbsm') == 'allOrdersdelivered' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Delivered Orders') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('dealer.allOrders', ['status'=>'cancelled', 'dealer'=>$dealer]) }}" class="nav-link {{ session('lsbsm') == 'allOrderscancelled' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Cancelled Orders') }}</p>
                </a>
              </li>

            </ul>
          </li> --}}
           
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
