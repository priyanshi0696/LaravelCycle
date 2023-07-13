<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard') }}" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('admin.dashboard') }}" class="d-block">Admin Panel</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{route('admin.dashboard') }}" class="nav-link active">
              <i class="icon-dashboard"></i>
              <p>
                Dashboard
                <i class="icon-dashboardt"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.user')}}" class="nav-link active">
                  <i class="fa fa-user"></i>
                  <p>User</p>
                </a>
              </li>

            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.banner')}}" class="nav-link active">
                    <i class="fas fa-sliders-h"></i>
                    <p>Banner</p>
                  </a>
                </li>

              </ul>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.product')}}" class="nav-link active">
                    <i class="fab fa-product-hunt"></i>
                    <p>Product</p>
                  </a>
                </li>

              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.client')}}" class="nav-link active">
                    <i class="fa fa-user"></i>
                    <p>Client</p>
                  </a>
                </li>

              </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
