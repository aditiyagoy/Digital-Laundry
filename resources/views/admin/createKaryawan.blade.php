{{-- Modal Body Tambah Data Karyawan/Lokasi --}}
<div class="p-2">
    <div class="form-group">
        <label for="nik_karyawan">NIK Karyawan</label>
        <input type="text" name="nik_karyawan" id="nik_karyawan" class="form-control">
    </div>
    <div class="form-group">
        <label for="nama_karyawan">Nama Karyawan</label>
        <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control">
    </div>
    <div class="form-group">
        <label for="id_lokasi">Lokasi Kerja</label>
        <select name="id_lokasi" id="id_lokasi" class="form-control">
            <option value="" selected>--Pilih Lokasi--</option>
            @foreach ($data as $item)
                <option value="{{ $item->id_lokasi }}">{{ $item->nama_lokasi }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="ukuran">Ukuran Baju</label>
        <select name="ukuran" id="ukuran" class="form-control">
            <option value="" selected>--Pilih Size--</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
        </select>
    </div>
    <div class="form-group">
        <label for="grup">Group</label>
        <input type="text" name="grup" id="grup" class="form-control">
    </div>
    <div class="modal-footer">
        <button class="btn btn-success" onclick="storeKaryawan()">Save</button>
    </div>
</div>
