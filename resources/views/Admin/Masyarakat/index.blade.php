@extends('layouts.admin')

@section('title', 'Halaman Masyarakat')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
@endsection

@section('header', 'Data Masyarakat')

@section('content')
    <table id="masyarakatTable" class="table">
        <thead>
            <tr>
                <th>No</th>
                <th style="text-align: left;">NIK</th>
                <th>Nama</th>
                <th>Username</th>
                <th style="text-align: left;">Telp</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($masyarakat as $k => $v)                        
            <tr>
                <td style="text-align: center;">{{ $k += 1 }}</td>
                <td style="text-align: left;">{{ $v->nik }}</td>
                <td>{{ $v->nama }}</td>
                <td>{{ $v->username }}</td>
                <td style="text-align: left;">{{ $v->telp }}</td>
                <td><a href="{{ route('masyarakat.show', $v->nik) }}" style="text-decoration: underline">Lihat</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script>
        new DataTable('#masyarakatTable');
    </script>
@endsection