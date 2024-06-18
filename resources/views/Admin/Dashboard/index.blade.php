@extends('layouts.admin')

@section('js')
    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}
@endsection

@section('css')
<style>
    .chart-container{
        margin-top: 20px;
        height: 400px;
        margin: 20px auto;
        width: 70%;
        display: block;
        padding-top: 15px;
        padding-left: 15px;
        padding-right: 15px;
    }
    .apexcharts-title-text, .apexcharts-xaxis-title, .apexcharts-yaxis-title {
        font-size: 16px !important;
        font-family: "Poppins", sans-serif !important;
    }
</style>
@endsection

@section('title', 'Halaman Dashboard')

@section('header', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">Petugas</div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $petugas }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">Masyarakat</div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $masyarakat }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">Pengaduan Proses</div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $proses }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">Pengaduan Selesai</div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $selesai }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="p-6 m-20 bg-white rounded shadow chart-container">
                {!! $chart->container() !!}
            </div>
        </div>
    </div>
@endsection