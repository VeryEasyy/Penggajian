<x-layout>
  <x-slot name="title">Karyawan</x-slot>

  @if (Session::has('success') || Session::has('error'))
    <meta http-equiv="refresh" content="1;url={{ route('gaji.gaji') }}">
  @endif
    
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Info Gaji</h1>
  </div>
  <div class="container mt-5">
    <div class="row">
        <div class="col-12">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <div class="btn-toolbar mb-4">
        <button type="button" class="btn btn-sm btn-success d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modal-tambah">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            Tambah
        </button>         
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center align-middle">Nama Karyawan</th>
                    <th scope="col" class="text-center align-middle">Jabatan</th>
                    <th scope="col" class="text-center align-middle">Tanggal Penggajian</th>
                    <th scope="col" class="text-center align-middle">Gaji Pokok</th>
                    <th scope="col" class="text-center align-middle">Total Tunjangan</th>
                    <th scope="col" class="text-center align-middle">Total Potongan</th>
                    <th scope="col" class="text-center align-middle">Gaji Bersih</th>
                    <th scope="col" class="text-center align-middle">PDF</th>
                    <th scope="col" class="text-center align-middle">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gaji as $g)
                <tr>
                    <td class="text-center align-middle">{{ $g->karyawan->nama ?? 'N/A' }}</td>
                    <td class="text-center align-middle">{{ $g->karyawan->jabatan->nama_jabatan ?? 'N/A' }}</td>
                    <td class="text-center align-middle">{{ $g->tanggal_penggajian ?? 'N/A' }}</td>
                    <td class="text-center align-middle">{{ number_format($g->karyawan->jabatan->gaji_pokok ?? 0, 0, ',', '.') }}</td>
                    <td class="text-center align-middle">{{ number_format($g->total_tunjangan, 0, ',', '.') }}</td>
                    <td class="text-center align-middle">{{ number_format($g->total_potongan, 0, ',', '.') }}</td>
                    <td class="text-center align-middle">{{ number_format($g->gaji_bersih, 0, ',', '.') }}</td>
                    {{-- <td class="text-center align-middle">
                        <div class="d-flex justify-content-center align-items-center h-100">
                            <button class="btn btn-primary btn-sm d-flex align-items-center me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle me-2" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                </svg>
                                Cetak PDF
                            </button>
                        </div>
                    </td> --}}
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center align-items-center h-100">
                            <button class="btn btn-warning btn-sm d-flex align-items-center me-2 edit" data-id="{{ $g->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                    <path d="M16 5l3 3" />
                                </svg>
                                Edit
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

     <!-- Modal Tambah -->
    <div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="modal-tambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-tambahLabel">Tambah Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadtambah">
                    <form action="{{ route('gaji.store') }}" method="POST">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="karyawan_id">Nama Karyawan</label>
                            <select class="form-control" name="karyawan_id" id="karyawan_id" required>
                                <option value="" disabled selected>Pilih Karyawan</option>
                                @foreach($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="jabatan">Jabatan</label>
                            <!-- Jabatan field updated dynamically -->
                            <input type="text" class="form-control" name="jabatan" id="jabatan" disabled>
                            <input type="hidden" name="jabatan_id" id="jabatan_id">
                        </div>
                        <div class="form-group mt-3">
                            <label for="tanggal_penggajian">Tanggal Penggajian</label>
                            <input type="date" class="form-control" name="tanggal_penggajian" id="tanggal_penggajian" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="tunjangan">Tunjangan</label>
                            <input type="number" class="form-control" name="total_tunjangan" id="total_tunjangan" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="potongan">Potongan</label>
                            <input type="number" class="form-control" name="total_potongan" id="total_potongan" required>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary w-100" type="submit">Tambah Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


  <!-- Modal Edit -->
  <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-editLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="modal-editLabel">Edit Data Karyawan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="loadedit">
                  
              </div>
          </div>
      </div>
  </div>
</x-layout>

<script>
   $(function(){
      $('#karyawan_id').on('change', function () {
        var karyawanId = $(this).val();

        if (karyawanId) {
            $.ajax({
                url: '/get-jabatan/' + karyawanId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        // Update jabatan field
                        $('#jabatan').val(data.nama_jabatan);
                        $('#jabatan_id').val(data.id);  // Assign hidden input value
                    } else {
                        $('#jabatan').val('');
                        $('#jabatan_id').val('');
                    }
                },
                error: function () {
                    $('#jabatan').val('');
                    $('#jabatan_id').val('');
                }
            });
        } else {
            $('#jabatan').val('');
            $('#jabatan_id').val('');
        }
    });

    $(".edit").click(function(){
          var id = $(this).data('id');

          $.ajax({
              type: 'POST',
              url: '/gaji/edit',
              cache: false,
              data:{
                _token: "{{ csrf_token() }}",
                id: id
              },
              success: function(respond){
                $("#loadedit").html(respond);
                
              }
          });
          $("#modal-edit").modal("show");
      });
      
      $(".hapus").click(function(e) {
            var form = $(this).closest('form');
            e.preventDefault();
            Swal.fire({
              title: "Apakah Anda Yakin Ingin Menghapus Data Ini?",
              showCancelButton: true,
              confirmButtonText: "Delete",
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                form.submit();
                Swal.fire("Data Berhasil Di Hapus!", "", "success");
              }
            });
      });
    });

</script>