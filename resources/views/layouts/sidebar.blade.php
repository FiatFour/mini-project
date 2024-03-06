<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="bg-header-dark">
      <div class="content-header bg-white-5">
        <!-- Logo -->
        <a class="fw-semibold text-white tracking-wide" href="index.html">
          <span class="smini-visible">
            D<span class="opacity-75">x</span>
          </span>
          <span class="smini-hidden">
            Dash<span class="opacity-75">mix</span>
          </span>
        </a>
        <!-- END Logo -->

        <!-- Options -->
        <div>

          <!-- Close Sidebar, Visible only on mobile screens -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
          <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout" data-action="sidebar_close">
            <i class="fa fa-times-circle"></i>
          </button>
          <!-- END Close Sidebar -->
        </div>
        <!-- END Options -->
      </div>
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
      <!-- Side Navigation -->
      <div class="content-side">
        <ul class="nav-main">
          <li class="nav-main-item">
            <a class="nav-main-link" href="{{ route('orders.index') }}">
              <i class="nav-main-link-icon fa fa-box"></i>
              <span class="nav-main-link-name">คำสั่งซื้อสินค้า</span>
            </a>
          </li>
          <li class="nav-main-item">
            <a class="nav-main-link" href="{{ route('products.index') }}">
              <i class="nav-main-link-icon fa fa-box"></i>
              <span class="nav-main-link-name">สินค้า</span>
            </a>
          </li>
          <li class="nav-main-item">
            <a class="nav-main-link" href="{{ route('categories.index') }}">
              <i class="nav-main-link-icon fa fa-toolbox"></i>
              <span class="nav-main-link-name">ประเภทสินค้า</span>
            </a>
          </li>
          <li class="nav-main-item">
            <a class="nav-main-link" href="{{ route('users.index') }}">
              <i class="nav-main-link-icon fa fa-user"></i>
              <span class="nav-main-link-name">บัญชีผู้ใช้งาน</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
  </nav>
