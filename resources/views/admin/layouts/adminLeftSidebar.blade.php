  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-2">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link bg-primary- w3-green text-center">
      {{-- <img src="{{ asset('img/dhpl.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> --}}
           <img class="" style="max-width: 80px; max-height:80px" src="{{ asset('img/dhpl.jpg') }}" alt="{{ env('APP_NAME') }}">
      {{-- <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span> --}}
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
               <li class="nav-item text-center">
                {{-- <img class="" style="max-width: 80px; max-height:80px" src="{{ asset('img/dhpl.jpg') }}" alt=""> --}}
               </li>
          <li class="nav-item has-treeview {{ session('lsbm') == 'dashboard' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt w3-text-blue"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item ">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ session('lsbsm') == 'dashboard' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview {{ session('lsbm') == 'roles' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-circle w3-text-blue"></i>
              <p>
                Role
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a href="{{ route('admin.adminsAll') }}" class="nav-link  {{ session('lsbsm') == 'adminsAll' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Admins</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('admin.factoryAll') }}" class="nav-link  {{ session('lsbsm') == 'factoryAll' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Factory</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('admin.rolesAll', 'depo') }}" class="nav-link  {{ session('lsbsm') == 'depo' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All GM</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('admin.rolesAll', 'distributor') }}" class="nav-link  {{ session('lsbsm') == 'distributor' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Distributors</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('admin.rolesAll', 'dealer') }}" class="nav-link  {{ session('lsbsm') == 'dealer' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All SMO</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('admin.rolesAll', 'agent') }}" class="nav-link  {{ session('lsbsm') == 'agent' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All SR</p>
                </a>
              </li>
            </ul>
          </li>


          {{-- <li class="nav-item has-treeview {{ session('lsbm') == 'projects' ? 'menu-open' : '' }}">
            <a href="{{ route('admin.projects') }}" class="nav-link ">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Projects
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li> --}}


          <li class="nav-item has-treeview {{ session('lsbm') == 'ecommerce' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-inbox w3-text-blue"></i>
              <p>
                Product Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.productCategories') }}" class="nav-link  {{ session('lsbsm') == 'productCategories' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Product Categories</p>
                </a>
              </li>

              {{-- <li class="nav-item ">
                <a href="{{ route('admin.ecommerce.salesLists') }}" class="nav-link {{ session('lsbsm') == 'salesList' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Sales Lists</p>
                </a>
              </li> --}}

              <li class="nav-item ">
                <a href="{{ route('admin.ecommerce.products') }}" class="nav-link {{ session('lsbsm') == 'products' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Products</p>
                </a>
              </li>

              {{-- <li class="nav-item ">
                <a href="{{ route('admin.ecommerce.orders') }}" class="nav-link {{ session('lsbsm') == 'orders' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Orders</p>
                </a>
              </li> --}}
              {{-- <li class="nav-item ">
                <a href="{{ route('admin.ecommerce.shipment.returns') }}" class="nav-link {{ session('lsbsm') == 'returns' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Returns</p>
                </a>
              </li> --}}
              {{-- <li class="nav-item ">
                <a href="{{ route('admin.ecommerce.users') }}" class="nav-link {{ session('lsbsm') == 'users' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Users</p>
                </a>
              </li> --}}
              {{-- <li class="nav-item ">
                <a href="{{ route('admin.shops') }}" class="nav-link {{ session('lsbsm') == 'sources' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Shops</p>
                </a>
              </li> --}}
              {{-- <li class="nav-item ">
                <a href="{{ route('admin.collections') }}" class="nav-link {{ session('lsbsm') == 'collections' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Collections</p>
                </a>
              </li> --}}


            </ul>
          </li>

          <li class="nav-item has-treeview {{ session('lsbm') == 'orders' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-shopping-bag w3-text-blue"></i>
              <p>
                Order Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('admin.ecommerce.orders') }}" class="nav-link {{ session('lsbsm') == 'allOrders' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Orders</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview {{ session('lsbm') == 'shops' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-store-alt w3-text-blue"></i>
              <p>
                Shop Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item ">
                <a href="{{ route('admin.shops') }}" class="nav-link {{ session('lsbsm') == 'allShops' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Shops</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview {{ session('lsbm') == 'collections' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-money-bill-wave w3-text-blue"></i>
              <p>
                Collection Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item ">
                <a href="{{ route('admin.collections') }}" class="nav-link {{ session('lsbsm') == 'allCollections' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Collections</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview {{ session('lsbm') == 'returns' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-exchange-alt w3-text-blue"></i>
              <p>
                Return Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item ">
                <a href="{{ route('admin.ecommerce.shipment.returns') }}" class="nav-link {{ session('lsbsm') == 'allReturns' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Returns</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview {{ session('lsbm') == 'commissions' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-coins w3-text-blue"></i>
              <p>
                Commissions
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item ">
                <a href="{{ route('admin.commissionList') }}" class="nav-link {{ session('lsbsm') == 'allCommissions' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Commission List</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item has-treeview {{ session('lsbm') == 'report' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-print w3-text-blue"></i>
              <p>
                Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              {{-- <li class="nav-item ">
                <a href="{{ route('admin.report', 'shop') }}" class="nav-link {{ session('lsbsm') == 'shop' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  Shop
                </a>
              </li> --}}
              <li class="nav-item ">
                <a href="{{ route('admin.report', 'order') }}" class="nav-link {{ session('lsbsm') == 'order' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  Order
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{ route('admin.report', 'collection') }}" class="nav-link {{ session('lsbsm') == 'collection' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  Collection
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{ route('admin.report', 'return') }}" class="nav-link {{ session('lsbsm') == 'return' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  Return
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{ route('admin.report', 'product') }}" class="nav-link {{ session('lsbsm') == 'product' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  Product Sales Report
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview {{ session('lsbm') == 'users' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-users w3-text-blue"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item ">
                <a href="{{ route('admin.ecommerce.users') }}" class="nav-link {{ session('lsbsm') == 'all' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User List</p>
                </a>
              </li>

            </ul>
          </li>

          {{-- <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Important</p>
            </a>
          </li> --}}

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

