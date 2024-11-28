<x-layout>
    <x-slot name="title">Jabatan</x-slot>

    @if (Session::has('success') || Session::has('error'))
        <meta http-equiv="refresh" content="1;url={{ route('jabatan.jabatan') }}">
    @endif

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Info Jabatan</h1>
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

        <div class="table-responsive mt-2">
            <table class="table table-striped table-bordered table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Gaji Pokok</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jabatans as $jabatan)
                        <tr>
                            <td>{{ $jabatan->nama_jabatan }}</td>
                            <td>{{ number_format($jabatan->gaji_pokok, 0, ',', '.') }}</td>
                            <td class="d-flex align-items-center">
                                <a href="#" class="btn btn-warning btn-sm d-flex align-items-center me-2 edit" id="edit" data-id="{{ $jabatan->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                    Edit
                                </a>

                                <form action="/jabatan/{{ $jabatan->id }}/delete" method="POST" style="display:inline;">
                                    @csrf
                                    <button class="btn btn-danger btn-sm d-flex align-items-center hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="modal-tambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-tambahLabel">Tambah Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadtambah">
                    <form action="/jabatan" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_jabatan">Nama Jabatan</label>
                            <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" placeholder="Masukkan Nama Jabatan" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="gaji_pokok">Gaji Pokok</label>
                            <input type="number" class="form-control" name="gaji_pokok" id="gaji_pokok" placeholder="Masukkan Gaji Pokok" required>
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
                    <h5 class="modal-title" id="modal-editLabel">Edit Data Jabatan</h5>
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
      $(".edit").click(function(){
          var id = $(this).data('id');

          $.ajax({
              type: 'POST',
              url: '/jabatan/edit',
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


