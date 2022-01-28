{{-- Modal Body Edit Data Karyawan/Lokasi --}}
<div class="p-2">
    <div class="form-group">
        <label for="id_barang">id Barang</label>
        <input type="text" name="id_barang" id="id_barang" class="form-control" value="{{ $item->id_barang }}">
    </div>
    <div class="form-group">
        <label for="nama_barang">Nama Barang</label>
        <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ $item->nama_barang }}">
    </div>
    <div class="form-group">
        <label for="id_lokasi">Lokasi Kerja</label>
        <select name="id_lokasi" id="id_lokasi" class="form-control">

            @foreach ($data2 as $item2)
                <option value="{{ $item2->id_lokasi }}"
                    {{ $item2->id_lokasi == $item->id_lokasi ? 'selected' : '' }}>
                    {{ $item2->nama_lokasi }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="jml_barang">Jumlah Barang</label>
        <input type="text" name="jml_barang" id="jml_barang" class="form-control" value="{{ $item->jml_barang }}">
    </div>
    <div class="modal-footer">
        <button class="btn btn-success" onclick="updateBarang({{ $item->id }})">Save</button>
    </div>
</div>
