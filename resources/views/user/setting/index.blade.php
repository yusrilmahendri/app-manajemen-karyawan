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
                <h5 class="card-title">Informasi Data Saya</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Nama</div>
                  <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                </div>

                @if(isset($user->email) && !empty($user->email))
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                </div>
                @endif
            
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Tanggal Daftar</div>
                  <div class="col-lg-9 col-md-8">{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</div>
                </div>

                @if($user->profesis->count() > 0)
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Profesi</div>
                  <div class="col-lg-9 col-md-8">
                    @foreach($user->profesis as $profesi)
                      {{ $profesi->name }}@if(!$loop->last), @endif
                    @endforeach
                  </div>
                </div>
                @endif
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
        $('.list-item').click(function() {
        $('.list-item').removeClass('active');
        $(this).addClass('active');
      });
    });
  </script>
@endpush
