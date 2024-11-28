<form action="/jabatan/{{ $jabatan->id }}/update" method="POST">
    @csrf
    <div class="form-group">
        <label for="nama_jabatan">Nama Jabatan</label>
        <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" value="{{ $jabatan->nama_jabatan }}" required>
    </div>
    <div class="form-group mt-3">
        <label for="gaji_pokok">Gaji Pokok</label>
        <input type="number" class="form-control" name="gaji_pokok" id="gaji_pokok" value="{{ $jabatan->gaji_pokok }}" required>
    </div>
    <div class="mt-4">
        <button class="btn btn-primary w-100" type="submit">Update Data</button>
    </div>
</form>
