<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQueryResult;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Pesanan;
use Illuminate\Contracts\View\View;
// Undefined type 'App\Exports\App\Exports\FromQueryResult'.intelephense(1009)
class LaporanPenjualanExport implements FromView
{

    private $awal;
    private $akhir;
    private $bulan;
    private $tahun;
    public function __construct($awal, $akhir, $bulan, $tahun)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }


    public function view(): View
    {
        if (!empty($this->awal) && !empty($this->akhir)) {
            return view('export.laporanpenjualan', [
                'penjualan'=> DB::table('pesanans')->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')->join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')->join('users', 'users.id','=', 'pesanans.user_id')
                ->whereBetween('pesanans.tanggal', [$this->awal, $this->akhir])->where('pesanans.status', 'Selesai')->get(),
                 'jumlah' => Pesanan::select(DB::raw('CAST(count(id) as UNSIGNED INTEGER) as total'))->whereBetween('pesanans.tanggal', [$this->awal, $this->akhir])->where('pesanans.status', 'Selesai')->first(),
                 'jlh_pesanan' => DB::table('pesanans')->join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')->select(DB::raw('SUM(pesanandetails.jumlah) as total'))->whereBetween('pesanans.tanggal', [$this->awal, $this->akhir])->where('pesanans.status', 'Selesai')->first(),
                 'total_harga' => DB::table('pesanans')->select(DB::raw('sum(total_harga) as total'))->whereBetween('pesanans.tanggal', [$this->awal, $this->akhir])->where('status', 'Selesai')->first(),
             ]);
        }
        if (!empty($this->bulan)) {
            $data = $this->bulan; //2023-05
            $arrayBulanTahun = explode("-", $data);
            return view('export.laporanpenjualan', [
               'penjualan'=> DB::table('pesanans')->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')->join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')->join('users', 'users.id','=', 'pesanans.user_id')
               ->WhereMonth('tanggal', '=', $arrayBulanTahun[1])->whereYear('tanggal', '=', $arrayBulanTahun[0])->where('pesanans.status', 'Selesai')->get(),
                'jumlah' => Pesanan::select(DB::raw('CAST(count(id) as UNSIGNED INTEGER) as total'))->WhereMonth('tanggal', '=', $arrayBulanTahun[1])->whereYear('tanggal', '=', $arrayBulanTahun[0])->where('pesanans.status', 'Selesai')->first(),
                'jlh_pesanan' => DB::table('pesanans')->join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')->select(DB::raw('SUM(pesanandetails.jumlah) as total'))->WhereMonth('tanggal', '=', $arrayBulanTahun[1])->whereYear('tanggal', '=', $arrayBulanTahun[0])->where('pesanans.status', 'Selesai')->first(),
                'total_harga' => DB::table('pesanans')->select(DB::raw('sum(total_harga) as total'))->WhereMonth('tanggal', '=', $arrayBulanTahun[1])->whereYear('tanggal', '=', $arrayBulanTahun[0])->where('status', 'Selesai')->first(),
            ]);
        }

        if (!empty($this->tahun)) {
            return view('export.laporanpenjualan', [
                'penjualan'=> DB::table('pesanans')->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')->join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')->join('users', 'users.id','=', 'pesanans.user_id')
                ->whereYear('pesanans.tanggal', $this->tahun)->where('pesanans.status', 'Selesai')->get(),
                 'jumlah' => Pesanan::select(DB::raw('CAST(count(id) as UNSIGNED INTEGER) as total'))->whereYear('pesanans.tanggal', $this->tahun)->where('pesanans.status', 'Selesai')->first(),
                 'jlh_pesanan' => DB::table('pesanans')->join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')->select(DB::raw('SUM(pesanandetails.jumlah) as total'))->whereYear('pesanans.tanggal', $this->tahun)->where('pesanans.status', 'Selesai')->first(),
                 'total_harga' => DB::table('pesanans')->select(DB::raw('sum(total_harga) as total'))->whereYear('pesanans.tanggal', $this->tahun)->where('status', 'Selesai')->first(),
             ]);
        }
    }
}
