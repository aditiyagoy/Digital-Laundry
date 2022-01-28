{{-- Modal Body Tambah Data Karyawan/Lokasi --}}
<div class="p-2">
    <div class="form-group">
        <label for="nama_kontraktor">Nama Kontraktor</label>
        <input type="text" name="nama_kontraktor" id="nama_kontraktor" class="form-control">
    </div>
    <div class="form-group">
        <label for="perusahaan">Perusahaan</label>
        <input type="text" name="perusahaan" id="perusahaan" class="form-control">
    </div>
    <div class="form-group">
        <label for="penanggung_jawab">Penanggung Jawab</label>
        <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control">
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
        <button class="btn btn-success" onclick="storeTransaksiKontraktor()">Save</button>
    </div>
</div>
