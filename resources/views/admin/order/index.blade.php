@extends('backend.default')

@section('content')
     <!-- tabel -->
   <div class="box-body">
         <table class="table table-bordered table-hover" 
         id="dataTable">
              <thead>
                  <tr>
                      <th>Nama Pelanggan</th>
                      <th>Nama Barang</th>
                      <th>Kategori</th>
                      <th>Nominal Harga</th>
                      <th>Deadline</th>
                      <th>Tindakan</th>
                  </tr>
              </thead>
          </table>
        </div>
   </div>

      <!-- trigger pada menghapus data -->
    <form action="" method="post" id="deleteForm">
        @csrf
        @method("DELETE")
        <input type="submit" value="Hapus"
        style="display: none ">
    </form>
@endsection()

@push('scripts')

<script src="{{ asset('backend/assets/js/notify.js') }}"></script>
<script src="{{ asset('backend/assets/js/notify.min.js') }}"></script>
@include('backend.partials.alerts')

 <script>
        $(function(){
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.order.api') }}",
                columns: [
                  {data: 'name_pelanggan'},
                  {data: 'name_jasa'},
                  {data: 'category'},
                  {data: 'price'},
                  {data: 'deadline'},
                  {data: 'action'}
                ]
            });
        });
     </script>
@endpush