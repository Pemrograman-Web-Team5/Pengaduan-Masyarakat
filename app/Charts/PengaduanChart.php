<?php

namespace App\Charts;

use App\Models\Pengaduan;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class PengaduanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    } 
   
    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $tahun = date('Y');
        $bulan = date('m');

        $dataBulan = [];
        $dataTotalPengaduan = [];

        for ($i = 1; $i <= $bulan; $i++){
            $selesai = Pengaduan::whereYear('created_at', $tahun)
                                ->whereMonth('created_at', $i)
                                ->count();
            $dataBulan[] = Carbon::create()->month($i)->format('F');
            $dataTotalPengaduan[] = $selesai;
        }
        return $this->chart->lineChart()
            ->setTitle('Data Pengaduan')
            ->setSubtitle('Total Pengaduan Setiap Bulan')
            ->addData('Total Pengaduan', $dataTotalPengaduan)
            ->setXAxis($dataBulan)            
            ->setColors(['#d30000'])            
            ->setHeight(350);                 
    }
}