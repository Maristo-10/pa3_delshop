<?php

namespace App\Exports;

use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQueryResult;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Carbon;
// Undefined type 'App\Exports\App\Exports\FromQueryResult'.intelephense(1009)
class LaporanPenjualanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
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


    public function collection()
    {
        // Ambil data penjualan berdasarkan permintaan pencarian
        if (!empty($this->awal) && !empty($this->akhir)) {
            return DB::table('pesanans')
                ->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')
                ->join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                ->select(
                    'pesanans.tanggal',
                    'pesanans.nama_pengambil',
                    'metodepembayarans.kapem',
                    'metodepembayarans.layanan',
                    DB::raw('SUM(pesanandetails.jumlah) as total_jumlah'),
                    'pesanans.total_harga',
                    // DB::raw('SUM(pesanans.total_harga) as total_harga')
                )
                ->whereBetween('pesanans.tanggal', [$this->awal, $this->akhir])
                ->where('pesanans.status', 'Selesai')
                ->groupBy(
                    'pesanans.tanggal',
                    'pesanans.nama_pengambil',
                    'metodepembayarans.kapem',
                    'metodepembayarans.layanan',
                    'pesanans.total_harga'
                )
                ->get();
                // ->groupBy('pesanans.tanggal', 'pesanans.nama_pengambil', 'metodepembayarans.kapem', 'metodepembayarans.layanan', 'pesanans.total_harga')
        } elseif (!empty($this->bulan)) {
            // Cari penjualan berdasarkan bulan
            $data = $this->bulan; //2023-05
            $arrayBulanTahun = explode("-", $data);
            // dd($arrayBulanTahun);
            return DB::table('pesanans')
                ->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')
                ->join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                ->select(
                    'pesanans.tanggal',
                    'pesanans.nama_pengambil',
                    'metodepembayarans.kapem',
                    'metodepembayarans.layanan',
                    DB::raw('SUM(pesanandetails.jumlah) as total_jumlah'),
                    'pesanans.total_harga',
                    // DB::raw('SUM(pesanans.total_harga) as total_harga')
                )
                ->whereMonth('pesanans.tanggal', $arrayBulanTahun[1])
                ->whereYear('pesanans.tanggal', $arrayBulanTahun[0])
                ->where('pesanans.status', 'Selesai')
                ->groupBy(
                    'pesanans.tanggal',
                    'pesanans.nama_pengambil',
                    'metodepembayarans.kapem',
                    'metodepembayarans.layanan',
                    'pesanans.total_harga'
                )
                ->get();
        } elseif (!empty($this->tahun)) {
            // Cari penjualan berdasarkan tahun
            return DB::table('pesanans')
                ->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')
                ->join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                ->select(
                    'pesanans.tanggal',
                    'pesanans.nama_pengambil',
                    'metodepembayarans.kapem',
                    'metodepembayarans.layanan',
                    DB::raw('SUM(pesanandetails.jumlah) as total_jumlah'),
                    'pesanans.total_harga',
                    // DB::raw('SUM(pesanans.total_harga) as total_harga'),
                )
                ->whereYear('pesanans.tanggal', $this->tahun)
                ->where('pesanans.status', 'Selesai')
                ->groupBy(
                    'pesanans.tanggal',
                    'pesanans.nama_pengambil',
                    'metodepembayarans.kapem',
                    'metodepembayarans.layanan',
                    'pesanans.total_harga'
                )
                ->get();
        }
    }

    public function headings(): array
    {
        return [
            'Tanggal Pesanan',
            'Nama Pengambil',
            'Metode Pembayaran',
            'Nama Layanan',
            'Jumlah Produk',
            'Total Harga',
        ];
    }

    // public function collection()
    // {
    //     return Pesanan::
    // }
}
