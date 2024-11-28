<form action="/karyawan/{{ $karyawan->id }}/update" method="POST">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control" name="nama" id="nama" value="{{ $karyawan->nama }}" required>
    </div>
    <div class="form-group mt-3">
      <select class="form-control" name="jabatan_id" required>
          @foreach($jabatans as $jabatan)
              <option value="{{ $jabatan->id }}" {{ $jabatan->id == $karyawan->jabatan_id ? 'selected' : '' }}>
                  {{ $jabatan->nama_jabatan }}
              </option>
          @endforeach
      </select>
    </div>
    <div class="form-group mt-3">
      <input type="text" class="form-control" name="alamat" id="alamat" value="{{ $karyawan->alamat }}" required>
    </div>
    <div class="form-group mt-3">
        <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" value="{{ $karyawan->tanggal_masuk->format('Y-m-d') }}" required>
    </div>
    <div class="form-group mt-3">
        <input type="text" class="form-control" name="no_telepon" id="no_telepon" value="{{ $karyawan->no_telepon }}" required>
    </div>
    <div class="form-group mt-3">
      <label for="status_karyawan">Status Karyawan</label>
      <select class="form-control" name="status_karyawan" id="status_karyawan" required>
          <option value="Kontrak" {{ $karyawan->status_karyawan == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
          <option value="Tetap" {{ $karyawan->status_karyawan == 'Tetap' ? 'selected' : '' }}>Tetap</option>
      </select>
    </div>
    <div class="mt-4">
        <button class="btn btn-primary w-100" type="submit">Update Data</button>
    </div>
</form>
