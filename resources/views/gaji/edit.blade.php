<form action="/gaji/{{ $gaji->id }}/update" method="POST">
    @csrf
    <div class="form-group">
        <label for="nama_karyawan">Nama Karyawan</label>
        <input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" value="{{ $gaji->karyawan->nama ?? 'N/A' }}" readonly>
    </div>
    <div class="form-group">
        <label for="jabatan">Jabatan</label>
        <!-- Disable the select to lock the options -->
        <select class="form-control" name="jabatan_disabled" id="jabatan" disabled>
            @foreach ($jabatans as $jabatan)
                <option value="{{ $jabatan->id }}" {{ $gaji->jabatan_id == $jabatan->id ? 'selected' : '' }}>
                    {{ $jabatan->nama_jabatan }}
                </option>
            @endforeach
        </select>
        <!-- Hidden input to submit the selected jabatan_id -->
        <input type="hidden" name="jabatan" value="{{ $gaji->jabatan_id }}">
    </div>
    <div class="form-group">
        <label for="tanggal_penggajian">Tanggal Penggajian</label>
        <input type="date" class="form-control" name="tanggal_penggajian" id="tanggal_penggajian" value="{{ $gaji->tanggal_penggajian->format('Y-m-d') }}" required>
    </div>
    <div class="form-group">
        <label for="tunjangan">Tunjangan</label>
        <input type="number" class="form-control" name="tunjangan" id="tunjangan" value="{{ $gaji->total_tunjangan }}" required>
    </div>
    <div class="form-group">
        <label for="potongan">Potongan</label>
        <input type="number" class="form-control" name="potongan" id="potongan" value="{{ $gaji->total_potongan }}" required>
    </div>
    <div class="form-group">
        <label for="gaji_bersih">Gaji Bersih</label>
        <input type="number" class="form-control" name="gaji_bersih" id="gaji_bersih" value="{{ $gaji->gaji_bersih }}" required>
    </div>
    <div class="mt-4">
        <button class="btn btn-primary w-100" type="submit">Update Data</button>
    </div>
</form>
