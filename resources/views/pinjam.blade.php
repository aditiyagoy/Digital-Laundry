@extends('navbar')


@section('content')
    <section id="transaksi">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-6 mb-3">
                    <h1 class="display-4">Digital Laundry</h1>
                    <p class="lead">Form Peminjaman</p>
                    <div class="card">
                        <div class="card-body">
                            <div class="p2">
                                <form method="POST" action="{{ url('transaksi') }}">
                                    <div class="form-group">

                                        @csrf
                                        <label for="id_karyawan">ID Karyawan</label>
                                        <select type="text" name="id_karyawan" id="id_karyawan"
                                            class="livesearch form-control"></select>
                                        <label for="nik_karyawan" style="margin-top: 5pt;">NIK Karyawan</label>
                                        <input type="text" name="nik_karyawan" id="nik_karyawan" class="form-control"
                                            readonly>
                                        <label for="nama_karyawan" style="margin-top: 5pt;">Nama Karyawan</label>
                                        <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control"
                                            readonly>
                                        <label for="barang" style="margin-top: 5pt;">Seragam</label>
                                        <!-- <select name="id_barang" id="id_barang" class="form-control">
                                                <option value="" disabled selected hidden>Jenis Pakaian</option>
                                                @foreach ($barang_db as $barang)
                                                <option value="{{ $barang['id_barang'] }}">{{ $barang['nama_barang'] }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <label for="jumlah" style="margin-top: 5pt;">Jumlah</label>
                                            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1"> -->
                                        @foreach ($barang_db as $barang)
                                            <div class="form-check">
                                                <label class="form-check-label"
                                                    for="{{ $barang['id_barang'] }}">{{ $barang['nama_barang'] }}</label>
                                                <input type="checkbox" name="barang[]" id="{{ $barang['id_barang'] }}"
                                                    class="form-check-input" value="{{ $barang['id_barang'] }}">

                                            </div>
                                        @endforeach
                                        <label for="" style="margin-top: 5pt;"></label>
                                        <button type="submit" class="btn btn-primary form-control">Pinjam</button>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <b>{{ $message }}</b>
                        </div>
                    @elseif ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <b>{{ $message }}</b>
                        </div>
                    @endif
                </div>

    </section>

    <!-- Galery End -->
    <!-- Button trigger modal -->
    <!-- Modal -->

    <script type="text/javascript">
        // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {

            $('#id_karyawan').select2({
                placeholder: 'ID Karyawan',
                ajax: {
                    url: '/ajax-autocomplete-search',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.id_karyawan,
                                    id: item.id_karyawan
                                }

                            }),
                        };
                    },

                    cache: true

                },

            });
            $('#id_karyawan').on('select2:select', function(data) {
                var id_karyawan = data.target.value;
                $.get("{{ url('getKaryawan') }}/" + id_karyawan,
                    function(data2) {
                        $('#nama_karyawan').val(data2.nama_karyawan);
                        $('#nik_karyawan').val(data2.nik);
                    })
            });

        });
    </script>

    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>


@endsection
