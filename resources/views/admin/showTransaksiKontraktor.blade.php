{{-- Modal Body Edit Data Karyawan/Lokasi --}}
<div class="p-2">
    <div class="form-group">
        <label for="nama_kontraktor">Nama Kontraktor</label>
        <input type="text" name="nama_kontraktor" id="nama_kontraktor" value="{{ $item->nama_kontraktor }}"
            class="form-control" readonly>
    </div>
    <div class="form-group">
        <label for="perusahaan">Perusahaan</label>
        <input type="text" name="perusahaan" id="perusahaan" value="{{ $item->perusahaan }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="perusahaan">Penanggung Jawab</label>
        <input type="text" name="penanggung_jawab" id="penanggung_jawab" value="{{ $item->penanggung_jawab }}"
            class="form-control">
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
        <button class="btn btn-success" onclick="updateTransaksiKontraktor({{ $item->id }})">Save</button>
    </div>
</div>
