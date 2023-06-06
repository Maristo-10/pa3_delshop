<?php

namespace App\Http\Controllers;

use App\Exports\LaporanPenjualanExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class LaporanPenjualanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function exportLaporanPenjualan(Request $request)
    {
        // Ambil data laporan berdasarkan permintaan pencarian
        // dd("Hello World");
        $awal = $request->tanggal_awal;
        $akhir = $request->tanggal_akhir;
        $bulan = $request->bulan_laporan;
        $tahun = $request->tahun_laporan;
        // dd($awal);

        // $penjualan = $this->getPenjualanData($awal, $akhir, $bulan, $tahun);
        // dd($penjualan);

        // Export data ke dalam file Excel
        // if(isset($awal) && isset($akhir)){
        //     return Excel::download(new LaporanPenjualanExport($awal, $akhir, $bulan, $tahun));s
        // }
        if($request->tanggal_awal){
            return Excel::download(new LaporanPenjualanExport($awal, $akhir, $bulan, $tahun), "laporan-penjualan-".$awal."-".$akhir.".xlsx");
        }

        if($request->bulan_laporan){
            return Excel::download(new LaporanPenjualanExport($awal, $akhir, $bulan, $tahun), "laporan-penjualan-".$bulan.".xlsx");
        }

        if($request->tahun_laporan){
            return Excel::download(new LaporanPenjualanExport($awal, $akhir, $bulan, $tahun), "laporan-penjualan-".$tahun.".xlsx");
        }

    }

}
