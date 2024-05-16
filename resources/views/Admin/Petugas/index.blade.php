    @extends('layouts.admin')

    @section('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    @endsection

    @section('header', 'Data Pengaduan')

    @section('content')
        <a href="{{ route('petugas.create')}}" class="btn btn-warning mb-2">Tambah Petugas</a>
        <table id="petugasTable" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Petugas</th>
                    <th>Username</th>
                    <th style="text-align: left;">Telp</th>
                    <th>Level</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <body>
                @foreach ($petugas as $k => $v)
                    <tr>
                        <td>{{ $k += 1 }}</td>
                        <td>{{ $v->nama_petugas }}</td>
                        <td>{{ $v->username }}</td>
                        <td style="text-align: left;">{{ $v->telp }}</td> 
                        <td>{{ $v->level }}</td>
                        <td><a href="{{ route ('petugas.edit', $v->id_petugas) }}" style="text-decoration: underline">Lihat</a></td>
                    </tr>
                @endforeach
            </body>
        </table>
    @endsection 

    @section('js')
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
        <script>
            $(document).ready(function() {
                $('#petugasTable').DataTable();
            } );
        </script>
    @endsection