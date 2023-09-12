<div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="assets/img/logo.png" alt="">
      <span class="d-none d-lg-block"> DR. GRAPHIA </span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <nav class="header-nav ms-auto">
    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
      <img src="{{ asset('backend/assets/img/profile-img.jpg') }}" style="margin-right:5px;" alt="Profile" class="rounded-circle">
      <span class="d-none d-md-block" style="margin-right:50px;" >
          {{ Auth::user()->name }}     
      </span>
    </a><!-- End Profile Iamge Icon -->
  </nav><!-- End Icons Navigation -->