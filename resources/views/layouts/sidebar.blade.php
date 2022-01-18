 <div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{url('dashboard')}}"> <img alt="image" src="{{ asset('public/assets/img/logo.png') }}" class="header-logo" style="height: 59px;width: 100px;" />
      </a>
    </div>
    <ul class="sidebar-menu">
      <li class="dropdown {{ request()->is('*dashboard*') ? 'active' : '' }}">
        <a href="{{ url('dashboard') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
      </li>
      <li class="dropdown {{ request()->is('products') || request()->is('category') || request()->is('holiday-list') || request()->is('sub-category') ? 'active' : '' }}">
          <a class="menu-toggle nav-link has-dropdown">
              <i data-feather="command"></i><span>Products</span>
          </a>
          <ul class="dropdown-menu">
              <li class="{{ request()->is('products') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ url('products') }}">Products</a>
              </li>
              <li class="{{ request()->is('category') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ url('category') }}">Category</a>
              </li>
              <li class="{{ request()->is('sub-category') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ url('sub-category') }}">Sub Category</a>
              </li>
          </ul>
      </li>
    </ul>
  </aside>
</div>