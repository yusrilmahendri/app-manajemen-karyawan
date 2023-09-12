<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      @if(Auth::user()->role == 'admin')
      <li class="nav-item">
        <a class="nav-link " href="{{ url('admin/dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="">
          <i class="ri-shopping-cart-2-line"></i><span>Order Service</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.order.create') }}">
              <i class="bi bi-circle"></i><span>Daftarkan Order</span>
            </a>
          </li>
        </ul>
  
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.orders') }}">
              <i class="bi bi-circle"></i><span>Riwayat Order</span>
            </a>
          </li>
        </ul>
      </li>
    @endif

    @if(Auth::user()->role == 'owner')

     <li class="nav-item">
      <a class="nav-link " href="{{ route('owner.dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="">
        <i class="ri-record-circle-line"></i><span>Record</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('owner.record') }}">
            <i class="bi bi-circle"></i><span>Riwayat Record Service</span>
          </a>
        </li>
      </ul>
    </li>

    
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-user-3-line"></i><span>Pengguna</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('owner.user') }}">
            <i class="bi bi-circle"></i><span>Daftarkan Pengguna</span>
          </a>
        </li>
        <li>
          <a href="{{ route('owner.users') }}">
            <i class="bi bi-circle"></i><span>Data Pengguna</span>
          </a>
        </li>
      </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a class="nav-link " href="{{ route('owner.setting.admin') }}">
        <i class="ri-admin-line"></i>
        <span>Setting Admin</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('owner.setting') }}">
        <i class="ri-file-settings-line"></i>
        <span>Setting</span>
      </a>
    </li><!-- End Contact Page Nav -->
    @endif

    @if(Auth::user()->role == 'user')
    <li class="nav-item">
      <a class="nav-link " href="{{ url('user/dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('user/todos') }}">
        <i class="ri-file-list-3-line"></i>
        <span>Pekerjaan Saya</span>
      </a>
    </li><!-- End Contact Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('user.settings') }}">
        <i class="ri-file-settings-line"></i>
        <span>Setting</span>
      </a>
    </li><!-- End Contact Page Nav -->


  @endif

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('/logout') }}">
        <i class="ri-logout-circle-line"></i>
        <span>Logout</span>
      </a>
    </li><!-- End Contact Page Nav -->

    </ul>
  </aside><!-- End Sidebar-->