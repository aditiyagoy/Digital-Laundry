<table class="table table-fluid table-hover table-striped mytable" id="myTable">
    <thead>
        <tr>
            <th width="80px">#</th>
            <th width="100px">NIK</th>
            <th width="300px">Nama Karyawan</th>
            <th width="150px">Lokasi Kerja</th>
            <th width="150px">Ukuran Baju</th>
            <th width="150px">Group</th>
            <th width="200px">Status Pinjam</th>
            <th>Act</th>
        </tr>
    </thead>
    <tbody>
        {{-- Menampilkan data dari database --}}
        @foreach ($data1 as $item1)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <th>{{ $item1->nik_karyawan }}</th>
                <th>{{ $item1->nama_karyawan }}</th>
                <th>{{ $item1->nama_lokasi }}</th>
                <th>{{ $item1->ukuran_baju }}</th>
                <th>{{ $item1->grup }}</th>
                {{-- @if ('{{ $item->status_peminjaman }}' == 0)
                    <th>Boleh Pinjam</th>
                @elseif ("{{ $item->status_peminjaman }}" == 1)
                    <th>Dilarang Pinjam</th>
                @endif --}}
                <th>
                    @if ($item1->status_peminjaman === 0)
                        Boleh Pinjam

                    @else
                        Dilarang Pinjam
                    @endif
                </th>
                <th>
                    <button class="btn btn-primary mr-2" onclick="showKaryawan({{ $item1->id }})"><i
                            class="fas fa-edit"></i></button>
                    <button class="btn btn-danger"
                        onclick="deleteKaryawan({{ $item1->id }},'{{ $item1->nama_karyawan }}')"><i
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
