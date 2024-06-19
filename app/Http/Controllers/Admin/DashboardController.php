<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\Petugas;
use Illuminate\Http\Request;
use App\Charts\PengaduanChart;

class DashboardController extends Controller
{
    public function index(PengaduanChart $chart){
        $petugas = Petugas::all()->count();
        $masyarakat = Masyarakat::all()->count();
        $pending = Pengaduan::where('status', '0')->get()->count();
        $proses = Pengaduan::where('status', 'proses')->get()->count();
        $selesai = Pengaduan::where('status', 'selesai')->get()->count();

        return view('Admin.Dashboard.index', ['petugas' => $petugas, 'masyarakat' => $masyarakat, 'pending' => $pending, 'proses' => $proses, 'selesai' => $selesai, 'chart' => $chart->build()]);
    }
}
