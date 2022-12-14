      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
              <li class="nav-item {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('dashboard') }}">
                      <i class="icon-grid menu-icon"></i>
                      <span class="menu-title">Dashboard</span>
                  </a>
              </li>

              @if (Auth::user()->HasRole('cashier'))
                  <li class="nav-item">
                      <a class="nav-link {{ request()->segment(1) == 'payment' ? 'active' : '' }}"
                          href="{{ route('orders.index') }}" aria-expanded="false" aria-controls="auth">
                          <i class="icon-head menu-icon"></i>
                          <span class="menu-title">Payment Order</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link {{ request()->segment(1) == 'tables' ? 'active' : '' }}"
                          href="{{ route('tables.index') }}" aria-expanded="false" aria-controls="auth">
                          <i class="ti-pie-chart menu-icon"></i>
                          <span class="menu-title">Data Meja</span>
                      </a>
                  </li>
              @endif

              @if (Auth::user()->HasRole('manager'))
                  <li class="nav-item {{ request()->segment(1) == 'category' ? 'active' : '' }}">
                      {{-- <li class="nav-item"> --}}
                      <a class="nav-link" data-toggle="collapse" href="#food-data" aria-expanded="false"
                          aria-controls="food-data">
                          <i class="icon-layout menu-icon"></i>
                          <span class="menu-title">Data Makanan</span>
                          <i class="menu-arrow"></i>
                      </a>
                      <div class="collapse" id="food-data">
                          <ul class="nav flex-column sub-menu">
                              <li class="nav-item"> <a class="nav-link"
                                      href="{{ route('category.index') }}">Kategori</a></li>
                              <li class="nav-item"> <a class="nav-link" href="{{ route('products.index') }}">Menu</a>
                              </li>
                          </ul>
                      </div>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link {{ request()->segment(1) == 'payment' ? 'active' : '' }}"
                          href="{{ route('orders.index') }}" aria-expanded="false" aria-controls="auth">
                          <i class="ti-shopping-cart menu-icon"></i>
                          <span class="menu-title">Data Order</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link {{ request()->segment(1) == 'spending' ? 'active' : '' }}"
                          href="{{ route('spending.index') }}" aria-expanded="false" aria-controls="auth">
                          <i class="ti-cloud-up menu-icon"></i>
                          <span class="menu-title">Data Pengeluaran</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link {{ request()->segment(1) == 'tables' ? 'active' : '' }}"
                          href="{{ route('tables.index') }}">
                          <i class="ti-pie-chart menu-icon"></i>
                          <span class="menu-title">Data Meja</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('employeeData.index') }}">
                          <i class="ti-user menu-icon"></i>
                          <span class="menu-title">Data Karyawan</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('report.index') }}">
                          <i class="ti-money menu-icon"></i>
                          <span class="menu-title">Laporan Keuangan</span>
                      </a>
                  </li>
              @endif
          </ul>
      </nav>
