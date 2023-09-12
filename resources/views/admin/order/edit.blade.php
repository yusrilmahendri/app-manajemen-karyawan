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
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Ubah Data Order</button>
              </li>
            </ul>

            <div class="tab-content pt-2">
              <div class="tab-pane fade show active profile-overview" id="profile-overview">        
                <h5 class="card-title">Details Data Order</h5>

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
                    <div class="col-lg-3 col-md-4 label">Nominal</div>
                    <div class="col-lg-9 col-md-8">{{ $order->price }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">deadline</div>
                    <div class="col-lg-9 col-md-8">{{ \Carbon\Carbon::parse($order->deadline)->format('d-m-Y') }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Tanggal Order dibuatkan</div>
                  <div class="col-lg-9 col-md-8">{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</div>
                </div>
                
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Penanggung Jawab</div>
                    <div class="col-lg-9 col-md-8">
                      <ul>
                            @foreach($order->users as $user)
                                <li>{{ $user->name }} seorang
                                    @foreach($user->profesis as $profesi)
                                        {{ $profesi->name }}
                                    @endforeach
                                </li>
                            @endforeach
                      </ul>
                    </div>
                </div>                
            </div>
        </div>

              

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="{{ route('admin.order.update', $order) }}" method="POST">

                  {{csrf_field()}}
                  @method("PUT")


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
                            @if($user->profesis)
                                @foreach($user->profesis as $profesi)
                                    <option value="{{ old('user_id[]') ?? $user->id }}">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            @endif
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
                            @if($user->profesis)
                                @foreach($user->profesis as $profesi)
                                    <option value="{{ old('user_id[]') ?? $user->id }}">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            @endif
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
                    <input type="text"name="price" class="form-control" id="inputEmail4" value="{{ old('price') ?? $order->price }}">
                    @error('price')
                      <span class="help-block"> {{ $message }}</span>
                    @enderror
                </div>
        
                <div class="col-12 @error('deadline') has-error @enderror">
                    <label for="inputEmail4" class="form-label">Tenggat Waktu</label>
                    <input type="date"name="deadline" class="form-control" id="inputEmail4" value="{{ old('deadline') ?? $order->deadline }}">
                    @error('deadline')
                      <span class="help-block"> {{ $message }}</span>
                    @enderror
                </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary" style="margin-top:25px;">Ubah Data Order</button>
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

  