<x-layout>
    <x-slot name="title">Slip Gaji</x-slot>
  
    @if (Session::has('success') || Session::has('error'))
      <meta http-equiv="refresh" content="1;url={{ route('gaji.gaji') }}">
    @endif
      
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Slip Gaji</h1>
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
      <div class="btn-toolbar mb-4 ">
        <button type="button" class="btn btn-success btn-sm d-flex align-items-center me-2" onclick="window.location.href='{{ route('gaji.downloadAllPdf') }}'">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-down me-1" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M7.646 10.854a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 9.293V5.5a.5.5 0 0 0-1 0v3.793L6.354 8.146a.5.5 0 1 0-.708.708z"/>
                <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383m.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
            </svg>
            Download Semua PDF
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
                      <td class="text-center align-middle">
                          <div class="d-flex justify-content-center align-items-center h-100">
                              <button class="btn btn-primary btn-sm d-flex align-items-center me-2 " onclick="window.location.href='{{ route('slipgaji.cetakpdf', $g->id) }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer me-1" viewBox="0 0 16 16">
                                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                                </svg>
                                  Cetak PDF
                              </button>
                          </div>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  
       <!-- Modal Tambah -->
      {{-- <div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="modal-tambahLabel" aria-hidden="true">
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
   --}}
  
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
     
  
  </script>