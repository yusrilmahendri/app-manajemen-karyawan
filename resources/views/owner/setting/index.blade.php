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
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Data Saya</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#password-edit">Ubah Password</button>
              </li>
            </ul>

            <div class="tab-content pt-2">
              <div class="tab-pane fade show active profile-overview" id="profile-overview">        
                <h5 class="card-title">Details Data Saya</h5>

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
              </div>

              

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="{{ route('owner.setting.profile', $user)}}" method="POST">

                  {{csrf_field()}}
                  @method("PUT")
                  
                  <div class="row mb-3 @error('name') has-error @enderror">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="Job" value="{{ old('name') ?? $user->name }}" required autocomplete="id" autofocus>
                    </div>

                    @error('name')
                     <span class="help-block"> {{ $message }}</span>
                   @enderror
                  </div>

                  <div class="row mb-3 @error('email') has-error @enderror">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Job" value="{{ old('email') ?? $user->email }}" required autocomplete="id" autofocus>
                    </div>

                    @error('email')
                       <span class="help-block"> {{ $message }}</span>
                    @enderror
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Ubah Data</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>


              <div class="tab-pane fade profile-edit pt-3" id="password-edit">

                <!-- Profile Edit Form -->
                <form action="{{ route('owner.setting.passwords', $user->id) }}" method="POST">

                  {{csrf_field()}}
                  @method("PUT")
                  
                  <div class="row mb-3 @error('passwordOld') has-error @enderror">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Password Old</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="passwordOld" type="password" class="form-control" id="Job" value="" required autocomplete="id" autofocus>
                    </div>

                    @error('passwordOld')
                       <span class="help-block"> {{ $message }}</span>
                    @enderror
                  </div>

                  <div class="row mb-3 @error('password') has-error @enderror">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Password New</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="Job" value="" required autocomplete="id" autofocus>
                    </div>

                    @error('password')
                       <span class="help-block"> {{ $message }}</span>
                    @enderror
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                  </div>
                </form><!-- End Profile Edit Form -->

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

  