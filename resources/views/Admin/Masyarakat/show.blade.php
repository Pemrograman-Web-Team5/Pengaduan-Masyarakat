@extends('layouts.admin')

@section('title', 'Detail Masyarakat')

@section('css')
    <style>
        .text-primary:hover{
            text-decoration: underline;
        }
        .text-grey{
            color: #6c757d;
        }
        .text-grey:hover{
            color: #6c757d;
        }
        .card{
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection

@section('header')
    <a href="{{ route('masyarakat.index') }}" class="text-primary">Data Masyarakat</a>
    <a href="#" class="text-grey">/</a>
    <a href="#" class="text-grey">Detail Masyarakat</a>
@endsection

@section('content')
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                            Detail Masyarakat
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>NIK</th>
                                    <td>:</td>
                                    <td>{{ $masyarakat->nik }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>:</td>
                                    <td>{{ $masyarakat->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td>:</td>
                                    <td>{{ $masyarakat->username }}</td>
                                </tr>
                                <tr>
                                    <th>No Telp</th>
                                    <td>:</td>
                                    <td>{{ $masyarakat->telp }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection