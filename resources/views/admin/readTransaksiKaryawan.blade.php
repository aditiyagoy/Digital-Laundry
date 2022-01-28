<table class="table table-fluid table-hover table-striped mytable" id="myTable">
    <thead style="align-content: center">
        <tr>
            <th width="80px">#</th>
            <th width="150px">NIK</th>
            <th width="250px">Nama Karyawan</th>
            <th width="250px">Nama Barang</th>
            <th width="300px">Tanggal Pinjam</th>
            <th width="300px">Tanggal Kembali</th>
            <th>Act</th>
        </tr>
    </thead>
    <tbody>
        {{-- Menampilkan data dari database --}}
        @foreach ($data as $item)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <th>{{ $item->nik_karyawan }}</th>
                <th>{{ $item->nama_karyawan }}</th>
                <th>{{ $item->nama_barang }}</th>
                <th>{{ $item->tgl_pinjam }}</th>
                <th>
                    @if ($item->tgl_kembali != null)
                        {{ $item->tgl_kembali }}
                    @else
                        Belum Kembali
                    @endif
                </th>
                <th><button class="btn btn-primary mr-2" onclick="showTransaksiKaryawan({{ $item->id }})"><i
                            class="fas fa-edit"></i></button>
                    <button class="btn btn-danger"
                        onclick="deleteTransaksiKaryawan({{ $item->id }},'{{ $item->nama_karyawan }}')"><i
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
