@extends('backend.default')

@section('content')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Daftarkan Order</h5>

      <!-- Vertical Form -->
      <form class="row g-3" action="{{ route('admin.order.store') }}" method="POST">
       
       @csrf

        <div class="col-12 @error('name_pelanggan') has-error @enderror">
          <label for="inputNanme4" class="form-label">Nama Pelanggan</label>
          <input type="text"  name="name_pelanggan" class="form-control" id="inputNanme4">
        
          @error('name_pelanggan')
            <span class="help-block"> {{ $message }}</span>
          @enderror
        </div>

        <div class="col-12 @error('name_jasa') has-error @enderror">
            <label for="inputNanme4" class="form-label">Nama Barang</label>
            <input type="text"  name="name_jasa" class="form-control" id="inputNanme4">
          
            @error('name_jasa')
              <span class="help-block"> {{ $message }}</span>
            @enderror
          </div>

          <div class="col-12">
            <div class="form-group">
                <label for="category">Kategori</label>
                <select name="category" class="form-control" id="kategori">
                    <option value="umum">UMUM</option>
                    <option value="mitra">MITRA</option>
                </select>
            </div>
        </div>
        
        <div class="col-12">
            <div class="form-group" id="penanggung-jawab-container">
                <label for="user_id">Penanggung Jawab</label>
                <select name="user_id[]" class="form-control select2" id="userDropdown">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-12">
            <div class="form-group" id="profesi-penanggung-jawab-container">
                <label for="profesi_id">Profesi Penanggung Jawab</label>
                <select name="profesi_id[]" class="form-control select2" id="profesiDropdown">
                    
                </select>
            </div>
        </div>
        
        <div class="col-12 @error('profesi') has-error @enderror">
            <div class="form-group" id="penanggung-jawab-tambahan">
                <label for="profesi_id">Penanggung Jawab</label>
                <select name="user_id[]" class="form-control select2" id="userDropdowns">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12">
            <div class="form-group" id="profesi-penanggung-jawab-tambahan-container">
                <label for="profesi_id">Profesi Penanggung Jawab</label>
                <select name="profesi_id[]" class="form-control select2" id="profesiDropdowns">
                    <!-- Options will be loaded dynamically via JavaScript -->
                </select>
            </div>
        </div>
        
        <div class="col-12 @error('price') has-error @enderror">
            <label for="inputEmail4" class="form-label">Harga</label>
            <input type="text"name="price" class="form-control" id="inputEmail4">
            @error('price')
              <span class="help-block"> {{ $message }}</span>
            @enderror
        </div>

        <div class="col-12 @error('deadline') has-error @enderror">
            <label for="inputEmail4" class="form-label">Tenggat Waktu</label>
            <input type="date"name="deadline" class="form-control" id="inputEmail4">
            @error('deadline')
              <span class="help-block"> {{ $message }}</span>
            @enderror
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
    $(document).ready(function () {
    $('#kategori').change(function () {
        if ($(this).val() === 'umum') {
            $('#penanggung-jawab-tambahan').show();
            $('#profesi-penanggung-jawab-tambahan-container').show();
        } else {
            $('#penanggung-jawab-tambahan').hide();
            $('#profesi-penanggung-jawab-tambahan-container').hide();
        }
    });

    // Listen for changes in the user dropdown
    $('#userDropdown').on('change', function () {
        var selectedUserId = $(this).val();
        // Clear the previous profession options
        $('#profesiDropdown').empty();
        // Fetch and add the professions of the selected user
        $.ajax({
            url: "{{ url('admin/api/order/users/',['{id}' => '']) }}" + '/' + selectedUserId,
            type: 'GET',
            success: function (data) {
                $.each(data.profesis, function (key, value) {
                    $('#profesiDropdown').append($('<option>', {
                        text: value.id,
                        text: value.name
                    }));
                });
            },
            error: function () {
                // Handle errors if necessary
            }
        });
    });
});
</script>

<script type="text/javascript">
    $('#userDropdowns').on('change', function () {
        var selectedUserId = $(this).val();
        // Clear the previous profession options
        $('#profesiDropdowns').empty();
        // Fetch and add the professions of the selected user
        $.ajax({
            url: "{{ url('admin/api/user/orders/',['{id}' => '']) }}" + '/' + selectedUserId,
            type: 'GET',
            success: function (data) {
                $.each(data.profesis, function (key, value) {
                    $('#profesiDropdowns').append($('<option>', {
                        text: value.id,
                        value: value.id, // Set the value attribute
                        text: value.name
                    }));
                });
            },
            error: function () {
                // Handle errors if necessary
            }
        });
    });
</script>
@endpush