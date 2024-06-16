<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $selesai = Pengaduan::where('status', 'selesai')->count();
        return view('user.landing', ['selesai' => $selesai]);
    }
}