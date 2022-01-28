<table class="table table-fluid table-hover table-striped mytable" id="myTable">
    <thead style="align-content: center">
        <tr>
            <th width="80px">#</th>
            <th width="200px">Nama Kontraktor</th>
            <th width="150px">Perusahaan</th>
            <th width="200px">Penanggung Jawab</th>
            <th width="200px">Nama Barang</th>
            <th width="200px">Tanggal Pinjam</th>
            <th width="200px">Tanggal Kembali</th>
            <th>Act</th>
        </tr>
    </thead>
    <tbody>
        {{-- Menampilkan data dari database --}}
        @foreach ($data as $item)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <th>{{ $item->nama_kontraktor }}</th>
                <th>{{ $item->perusahaan }}</th>
                <th>{{ $item->penanggung_jawab }}</th>
                <th>{{ $item->nama_barang }}</th>
                <th>{{ $item->tgl_pinjam }}</th>
                <th>
                    @if ($item->tgl_kembali != null)
                        {{ $item->tgl_kembali }}
                    @else
                        Belum Kembali
                    @endif
                </th>
                <th><button class="btn btn-primary mr-2" onclick="showTransaksiKontraktor({{ $item->id }})"><i
                            class="fas fa-edit"></i></button>
                    <button class="btn btn-danger"
                        onclick="deleteTransaksiKontraktor({{ $item->id }},'{{ $item->nama_karyawan }}')"><i
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
