{{-- Modal Body Edit Data Karyawan/Lokasi --}}
<div class="p-2">
    <div class="form-group">
        <label for="nik_karyawan">Nama Karyawan</label>
        <select name="nik_karyawan" id="nik_karyawan" class="form-control">

            @foreach ($data1 as $item1)
                <option value="{{ $item1->nik_karyawan }}"
                    {{ $item1->nik_karyawan == $item->nik_karyawan ? 'selected' : '' }}>
                    {{ $item1->nama_karyawan }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="id_barang">Nama Barang</label>
        <select name="id_barang" id="id_barang" class="form-control">

            @foreach ($data3 as $item3)
                <option value="{{ $item3->id_barang }}"
                    {{ $item3->id_barang == $item->id_barang ? 'selected' : '' }}>
                    {{ $item3->nama_barang }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="tgl_pinjam">Tanggal Pinjam</label>
        <input type="datetime-local" name="tgl_pinjam" id="tgl_pinjam" class="form-control"
            value="{{ date('Y-m-d\TH:i', strtotime($item->tgl_pinjam)) }}">
    </div>
    <div class="form-group">
        <label for="tgl_kembali">Tanggal Kembali</label>
        <input type="datetime-local" name="tgl_kembali" id="tgl_kembali" class="form-control"
            value="{{ $item->tgl_kembali == '' ? '' : date('Y-m-d\TH:i', strtotime($item->tgl_kembali)) }}">
    </div>

    <div class="modal-footer">
        <button class="btn btn-success" onclick="updateTransaksiKaryawan({{ $item->id }})">Save</button>
    </div>
</div>
