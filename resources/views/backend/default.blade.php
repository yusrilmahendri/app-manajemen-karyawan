<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

    @include('backend.partials.styles')

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    @include('backend.partials.navbar')
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('backend.partials.sidebar')

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>{{ Breadcrumbs::current()->title }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">{{ Breadcrumbs::render() }}
          </li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row align-items-top">
        <div class="col-lg-12">

          <!-- Default Card -->
          <div class="card">
            <div class="card-body">
                @yield('content')
            </div>
          </div><!-- End Default Card -->
        </div>
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Yusril Mahendri</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    
    @include('backend.partials.scripts')
    
    </body>
</html>