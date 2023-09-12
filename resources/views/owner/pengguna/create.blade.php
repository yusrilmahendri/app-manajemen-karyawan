@extends('backend.default')

@section('content')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Daftarkan Pengguna</h5>

      <!-- Vertical Form -->
      <form class="row g-3" action="{{ route('owner.user.create') }}" method="POST">
       
       @csrf

        <div class="col-12 @error('name') has-error @enderror">
          <label for="inputNanme4" class="form-label">Name</label>
          <input type="text"  name="name" class="form-control" id="inputNanme4">
        
          @error('name')
            <span class="help-block"> {{ $message }}</span>
          @enderror
        </div>

        <div class="col-12 @error('email') has-error @enderror">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email"name="email" class="form-control" id="inputEmail4">
          @error('email')
            <span class="help-block"> {{ $message }}</span>
          @enderror
        </div>

        <div class="col-12 @error('password') has-error @enderror">
            <label for="inputEmail4" class="form-label">Password</label>
            <input type="password"name="password" class="form-control" id="inputEmail4">
            @error('password')
              <span class="help-block"> {{ $message }} </span>
            @enderror
        </div>

        <div id="profesiContainer">
          <a type="button" id="addProfesi" style="position: relative; float: right; margin-right: 0px; margin-left: 350px;">
            <i class="ri-add-circle-line x-plus">Tambah Profesi</i>
          </a>
      
          <!-- Input profesi yang sudah ada -->
          <div class="form-group">
              <label for="profesi_id">Profesi</label>
              <select name="profesi_id[]" class="form-control select2">
                  @foreach($profesis as $profesi)
                      <option value="{{ $profesi->id }}">
                          {{ $profesi->name }}
                      </option>
                  @endforeach
              </select>
          </div>
      </div>
      

        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>

      </form><!-- Vertical Form -->

    </div>
  </div>
@endsection

@push('select2css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/select2.min.css') }}">
@endpush

@push('scripts')
  <script src="{{ asset('backend/assets/js/notify.js') }}"></script>
  <script src="{{ asset('backend/assets/js/notify.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/select2.full.min.js') }}"></script>
  @include('backend.partials.alerts')
  
    
  <script>
     $('.select2').select2();
  </script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const addProfesiButton = document.getElementById('addProfesi');
      const profesiContainer = document.getElementById('profesiContainer');

      addProfesiButton.addEventListener('click', function () {
          const profesiInput = document.createElement('div');
          profesiInput.innerHTML = `
              <div class="form-group" style="margin-top:15px;">
                  <label for="profesi_id">Profesi</label>
                  <select name="profesi_id[]" class="form-control select2">
                      @foreach($profesis as $profesi)
                          <option value="{{ $profesi->id }}">
                              {{ $profesi->name }}
                          </option>
                      @endforeach
                  </select>

                  <button type="button" class="btn btn-danger removeProfesi" style="margin-top:15px;">
                    <i class="ri-delete-bin-5-fill">
                      Cancel Tambah Profesi
                    </i>  
                  </button>
              </div>
          `;
          profesiContainer.appendChild(profesiInput);
      });

      // Fungsi untuk menghapus form
      profesiContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('removeProfesi')) {
                event.target.parentElement.remove();
            }
        });
  });
</script>

@endpush