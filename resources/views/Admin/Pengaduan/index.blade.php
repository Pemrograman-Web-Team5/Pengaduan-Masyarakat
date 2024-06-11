@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
@endsection

@section('header', 'Data Pengaduan')

@section('content')
    <table id="pengaduanTable" class="table">
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th>Tanggal</th>
                <th>Isi Laporan</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengaduan as $k => $v)            
            <tr>
                <td style="text-align: center;">{{ $k += 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($v->tgl_pengaduan)->format('d-M-Y') }}</td>
                <td>{{ $v->isi_laporan }}</td>
                <td>
                    @if ($v->status == '0')
                        <a href="#" class="badge badge-danger">Pending</a>
                    @elseif ($v->status == 'proses')
                        <a href="#" class="badge badge-warning text-white">Proses</a>
                    @else
                        <a href="#" class="badge badge-success">Selesai</a>
                    @endif
                </td>
                <td><a href="{{ route('pengaduan.show', $v->id_pengaduan) }}" style="text-decoration: underline;">Lihat</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script>
        new DataTable('#pengaduanTable');
    </script>
@endsection