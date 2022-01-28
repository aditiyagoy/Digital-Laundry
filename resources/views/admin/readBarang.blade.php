<table class="table table-fluid table-hover table-striped mytable" id="myTable">
    <thead>
        <tr>
            <th width="80px">#</th>
            <th width="300px">Id Barang</th>
            <th width="300px">Nama Barang</th>
            <th width="300px">Lokasi Barang</th>
            <th width="300px">Jumlah Barang</th>
            <th>Act</th>
        </tr>
    </thead>
    <tbody>
        {{-- Menampilkan data dari database --}}
        @foreach ($data as $item)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <th>{{ $item->id_barang }}</th>
                <th>{{ $item->nama_barang }}</th>
                <th>{{ $item->nama_lokasi }}</th>
                <th>{{ $item->jml_barang }}</th>
                <th><button class="btn btn-primary mr-2" onclick="showBarang({{ $item->id }})"><i
                            class="fas fa-edit"></i></button>
                    <button class="btn btn-danger"
                        onclick="deleteBarang({{ $item->id }},'{{ $item->nama_barang }}')"><i
                            class="fas fa-trash"></i></button>
                </th>
            </tr>
        @endforeach
    </tbody>



</table>
{{-- <div class="pagination justify-content-start">
    {{ $data->lastItem() }} of {{ $data->total() }}
</div>
<div class="pagination justify-content-end">
    {{ $data->links() }}
</div> --}}
