<a href="{{ route('user.todo.show', $model)}}"
   class="btn btn-warning">
   <div class="icon">
    <i class="ri-calendar-todo-fill">
        Detail Informasi
    </i>
  </div>
</a>


    <button href="{{ route('user.orders.complete', $model) }}" class="btn btn-danger" id="delete" style="margin-top:15px;">
        <div class="icon">
            <i class="ri-check-line">
                Pekerjaan Selesai
            </i>
        </div>
    </button>




<!-- sweat alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('button#delete').on('click', function(e){
         e.preventDefault();
         var href = $(this).attr('href');
         //sweat alert
         Swal.fire({
            title: 'Apakah yakin order ini sudah anda selesaikan?',
            text: "Data yang sudah disubmitkan tidak bisa dikembalikan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, saya yakin order sudah saya selesaikan'
          }).then((result) => {
            if (result.isConfirmed) {
              document.getElementById('deleteForm').action = href;
              document.getElementById('deleteForm').submit();
              Swal.fire(
                'terimakasih',
                'anda sudah menyelesaikan order',
                'success'
              )
            }
          });
   });
</script>
