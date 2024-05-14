<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    public function createOrUpdate(Request $request) 
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $request->id_pengaduan)->first();

        $tanggapan = Tanggapan::where('id_pengaduan', $request->id_pengaduan)->first();

        if(condition){
            $pengaudan->update(['status' => $request->status]);

            $tanggapan->update([
                'tgl_tanggapan' =>date('Y-m-d'),
                'tanggapan' =>$request->tanggapan,
                'id_petugas' =>Auth::guard('admin')->user()->id_petugas,
            ]);

            return redirect()->route('pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan]);
        } else {
            $pengaudan->update(['status' => $request->status]);

            $tanggapan = Tanggapan::create([
                'id_pengaduan' => $request->id_pengaduan,
                'tgl_tanggapan' =>date('Y-m-d'),
                'tanggapan' =>$request->tanggapan,
                'id_petugas' =>Auth::guard('admin')->user()->id_petugas,
            ]);

            return redirect()->route('pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan])->with(['status' => 'Berhasil Dikirim' ]);
        }
    }
}
