@extends('backend.default')

@section('content')
<section class="section dashboard">


      <!-- Left side columns -->
      <div class="col-lg-15">
        <div class="row">
          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Total Pengguna / Karyawan</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                        {{ $totalUser }}
                    </h6>
                    <span class="text-muted small pt-2 ps-1">total karyawan / pengguna yang dimiliki </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
