<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Pengaduan;

class UserController extends Controller
{
    public function index()
    {
        return view('user.landing');
    }

    public function login(Request $request)
    {
        $username = Masyarakat::where('username', $request->username)->first();

        if (!$username) {
            return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
        }

        $password = Hash::check($request->password, $username->password);

        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
        }

        if (Auth::guard('masyarakat')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->back();
        } else {
            return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
        }
    }

    public function formRegister()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nik' => ['required'],
            'nama' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'telp' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with(['pesan' => $validate->errors()]);
        }

        $username = Masyarakat::where('username', $request->username)->first();

        if ($username) {
            return redirect()->back()->with(['pesan' => 'Username sudah terdaftar']);
        }

        Masyarakat::create([
            'nik' => $data['nik'],
            'nama' => $data['nama'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
        ]);

        return redirect()->route('pekat.index');
    }

    public function logout()
    {
        Auth::guard('masyarakat')->logout();

        return redirect()->back();
    }

    public function storePengaduan(Request $request)
    {
        //memerikasa apakah user sudah login
        if (!Auth::guard('masyarakat')->check()) { // Perubahan di sini
            return redirect()->route('pekat.index')->with(['pesan' => 'Silakan login terlebih dahulu']); // Perubahan di sini
        }

        // Validasi data input
        $data = $request->validate([
            'isi_laporan' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // Penyimpanan foto 
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('assets/pengaduan', 'public');
        }

        // Buat pengaduan baru
        $pengaduan = Pengaduan::create([
            'tgl_pengaduan' => now(),
            'nik' => Auth::guard('masyarakat')->user()->nik,
            'isi_laporan' => $data['isi_laporan'],
            'foto' => $data['foto'] ?? null, // memastikan foto disimpan jika ada
            'status' => '0',
        ]);

        if ($pengaduan) {
            return redirect()->route('pekat.laporan', 'me')
                ->with(['pengaduan' => 'Berhasil terkirim!', 'type' => 'success']);
        } else {
            return redirect()->back()
                ->with(['pengaduan' => 'Gagal terkirim!', 'type' => 'danger']);
        }
    }

    public function laporan($siapa = '')
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::guard('masyarakat')->check()) {
            return redirect()->route('pekat.index');
        }

        // Ambil user yang sedang login
        $user = Auth::guard('masyarakat')->user();

        // Ambil jumlah laporan berdasarkan status
        $terverifikasi = Pengaduan::where('nik', $user->nik)
            ->where('status', '!=', '0')
            ->get()
            ->count();

        $proses = Pengaduan::where('nik', $user->nik)
            ->where('status', 'proses')
            ->get()
            ->count();

        $selesai = Pengaduan::where('nik', $user->nik)
            ->where('status', 'selesai')
            ->get()
            ->count();

        $hitung = [$terverifikasi, $proses, $selesai];

        // Ambil data pengaduan berdasarkan siapa yang mengakses (semua atau hanya laporan saya)
        if ($siapa == 'me') {
            $pengaduan = Pengaduan::where('nik', $user->nik)
                ->orderBy('tgl_pengaduan', 'desc')
                ->get();

            return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
        } else {
            $pengaduan = Pengaduan::where('nik', '!=', $user->nik)
                ->where('status', '!=', '0')
                ->orderBy('tgl_pengaduan', 'desc')
                ->get();

            return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
        }
    }
}
