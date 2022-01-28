{{-- Modal Body Edit Data Area/Lokasi --}}
<div class="p-2">
    {{-- @foreach ($data as $item) --}}


    <div class="form-group">
        <label for="id_lokasi">Id Lokasi</label>
        <input type="text" name="id_lokasi" id="id_lokasi" value="{{ $item->id_lokasi }}" class="form-control"
            readonly>
    </div>
    <div class="form-group">
        <label for="nama_lokasi">Nama Lokasi</label>
        <input type="text" name="nama_lokasi" id="nama_lokasi" value="{{ $item->nama_lokasi }}" class="form-control">
    </div>
    <div class="modal-footer">
        <button class="btn btn-success" onclick="updateArea({{ $item->id }})">Update</button>
    </div>

    {{-- @endforeach --}}
</div>
