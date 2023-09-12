@extends('backend.default')

@section('content')
<section class="section profile">
    <div class="row">
      <div class="col-xl-20">
        <div class="card">
          <div class="card-body pt-3">

            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>

            </ul>
            <div class="tab-content pt-2">
              <div class="tab-pane fade show active profile-overview" id="profile-overview">        
                <h5 class="card-title">Detail list pekerjaan saya</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Nama Pelanggan</div>
                  <div class="col-lg-9 col-md-8">{{ $order->name_pelanggan }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Nama Barang</div>
                  <div class="col-lg-9 col-md-8">{{ $order->name_jasa }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Kategori</div>
                    <div class="col-lg-9 col-md-8">{{ $order->category }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nominal Harga</div>
                    <div class="col-lg-9 col-md-8">{{ $order->price }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Jenis Order</div>
                    <div class="col-lg-9 col-md-8">
                        @if ($order->user && !$order->user->profesis->isEmpty())
                            @foreach ($order->user->profesis as $profesi)
                                {{ $profesi->name }}
                            @endforeach
                        @else
                            No user or professions found.
                        @endif
                    </div>
                </div>
                
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Deadline</div>
                    <div class="col-lg-9 col-md-8">{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</div>
                  </div>

              </div>
            </div><!-- End Bordered Tabs -->

          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
  @push('scripts')  
    <script src="{{ asset('backend/assets/js/notify.js') }}"></script>
    <script src="{{ asset('backend/assets/js/notify.min.js') }}"></script>
    @include('backend.partials.alerts')
    <!-- sweat alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @endpush