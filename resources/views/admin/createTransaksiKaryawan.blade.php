{{-- Modal Body Tambah Data Karyawan/Lokasi --}}
<div class="p-2">
    <div class="form-group">
        <label for="nik_karyawan">Nama Karyawan</label>
        <select name="nik_karyawan" id="nik_karyawan" class="form-control">
            <option value="" selected>Pilih Karyawan</option>
            @foreach ($data1 as $item1)
                <option value="{{ $item1->nik_karyawan }}">{{ $item1->nama_karyawan }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="id_barang">Barang</label>
        <select name="id_barang" id="id_barang" class="form-control">
            <option value="" selected>--Pilih Barang--</option>
            @foreach ($data as $item)
                <option value="{{ $item->id_barang }}">{{ $item->nama_barang }}</option>
            @endforeach
        </select>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success" onclick="storeTransaksiKaryawan()">Save</button>
    </div>
</div>
