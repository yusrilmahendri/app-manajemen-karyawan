@extends('backend.default')

@section('content')
     <!-- tabel -->
   <div class="box-body">
         <table class="table table-bordered table-hover"
         id="dataTable">
              <thead>
                  <tr>
                      <th>Username</th>
                      <th>Desainer</th>
                      <th>Outdor</th>
                      <th>DTF</th>
                      <th>Konika</th>
                      <th>Laser</th>
                  </tr>
              </thead>
          </table>
        </div>
   </div>

   <div class="container cetak">
    <a href="{{ route('owner.generateRecordPdf') }}" class="btn btn-outline-primary btn-cetak">
        CETAK
    </a>
</div>
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
                ajax: "{{ route('owner.api.record') }}",
                columns: [
                { data: "name" },
                { data: "qty_desainer" },
                { data: "qty_konika" },
                { data: "qty_outdor" },
                { data: "qty_dtf" },
                { data: "qty_laser" }
                ]
            });
        });
     </script>
@endpush
