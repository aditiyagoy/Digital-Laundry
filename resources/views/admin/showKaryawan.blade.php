{{-- Modal Body Edit Data Karyawan/Lokasi --}}
<div class="p-2">
    <div class="form-group">
        <label for="nik_karyawan">NIK Karyawan</label>
        <input type="text" name="nik_karyawan" id="nik_karyawan" class="form-control"
            value="{{ $item->nik_karyawan }}">
    </div>
    <div class="form-group">
        <label for="nama_karyawan">Nama Karyawan</label>
        <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control"
            value="{{ $item->nama_karyawan }}">
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
        <label for="ukuran">Ukuran Baju</label>
        <select name="ukuran" id="ukuran" class="form-control">
            <option value="" selected>--Pilih Size--</option>
            <option value="S" {{ $item->ukuran_baju == 'S' ? 'selected' : '' }}>S</option>
            <option value="M" {{ $item->ukuran_baju == 'M' ? 'selected' : '' }}>M</option>
            <option value="L" {{ $item->ukuran_baju == 'L' ? 'selected' : '' }}>L</option>
            <option value="XL" {{ $item->ukuran_baju == 'XL' ? 'selected' : '' }}>XL</option>
            <option value="XXL" {{ $item->ukuran_baju == 'XXL' ? 'selected' : '' }}>XXL</option>
        </select>
    </div>
    <div class="form-group">
        <label for="grup">Group</label>
        <input type="text" name="grup" id="grup" class="form-control" value="{{ $item->grup }}">
    </div>
    <div class="modal-footer">
        <button class="btn btn-success" onclick="updateKaryawan({{ $item->id }})">Save</button>
    </div>
</div>
