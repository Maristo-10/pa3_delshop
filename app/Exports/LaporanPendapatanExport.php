<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Pesanan;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LaporanPendapatanExport implements FromView
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
            return view('export.laporanlabarugi', [
                'produk' => DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')
                    ->join('pesanans', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                    ->where('pesanans.status', 'Selesai')
                    ->whereBetween('pesanans.tanggal', [$this->awal, $this->akhir])
                    ->select('produk.nama_produk', 'produk.modal', 'produk.harga', 'pesanandetails.jumlah')
                    ->selectRaw('SUM(pesanandetails.jumlah) as jumlah_pesanan')
                    ->selectRaw('SUM(pesanandetails.modal_details) as jumlah_modal')
                    ->selectRaw('SUM(pesanandetails.jumlah_harga) as jumlah_harga')
                    ->groupBy('produk.id_produk', 'produk.nama_produk', 'produk.modal', 'produk.harga', 'pesanandetails.jumlah')
                    ->get(),

                'total' => DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')
                ->join('pesanans', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                ->where('pesanans.status', 'Selesai')
                ->whereBetween('pesanans.tanggal', [$this->awal, $this->akhir])
                ->select('produk.nama_produk', 'produk.modal', 'produk.harga', 'pesanandetails.jumlah')
                ->selectRaw('SUM(pesanandetails.jumlah) as jumlah_pesanan')
                ->selectRaw('SUM(pesanandetails.modal_details) as jumlah_modal')
                ->selectRaw('SUM(pesanandetails.jumlah_harga) as jumlah_harga')
                ->groupBy('produk.id_produk', 'produk.nama_produk', 'produk.modal', 'produk.harga', 'pesanandetails.jumlah')
                ->count(),

                'total_terjual' => DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')
                    ->join('pesanans', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                    ->where('pesanans.status', 'Selesai')
                    ->whereBetween('pesanans.tanggal', [$this->awal, $this->akhir])
                    ->select('pesanans.status')
                    ->selectRaw('SUM(pesanandetails.jumlah) as jumlah_pesanan')
                    ->groupBy('pesanans.status')
                    ->first(),

                'total_modal' => DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')
                    ->join('pesanans', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                    ->where('pesanans.status', 'Selesai')
                    ->whereBetween('pesanans.tanggal', [$this->awal, $this->akhir])
                    ->select('pesanans.status')
                    ->selectRaw('SUM(pesanandetails.modal_details) as jumlah_modal')
                    ->groupBy('pesanans.status')
                    ->first(),

                'total_harga' => DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')
                    ->join('pesanans', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                    ->where('pesanans.status', 'Selesai')
                    ->whereBetween('pesanans.tanggal', [$this->awal, $this->akhir])
                    ->select('pesanans.status')
                    ->selectRaw('SUM(pesanandetails.jumlah_harga) as harga_terjual')
                    ->groupBy('pesanans.status')
                    ->first(),
            ]);
        }
        if (!empty($this->bulan)) {
            $data = $this->bulan; //2023-05
            $arrayBulanTahun = explode("-", $data);
            return view('export.laporanlabarugi', [
                'produk' => DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')
                    ->join('pesanans', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                    ->where('pesanans.status', 'Selesai')
                    ->WhereMonth('tanggal', '=', $arrayBulanTahun[1])->whereYear('tanggal', '=', $arrayBulanTahun[0])
                    ->select('produk.nama_produk', 'produk.modal', 'produk.harga', 'pesanandetails.jumlah')
                    ->selectRaw('SUM(pesanandetails.jumlah) as jumlah_pesanan')
                    ->selectRaw('SUM(pesanandetails.modal_details) as jumlah_modal')
                    ->selectRaw('SUM(pesanandetails.jumlah_harga) as jumlah_harga')
                    ->groupBy('produk.id_produk', 'produk.nama_produk', 'produk.modal', 'produk.harga', 'pesanandetails.jumlah')
                    ->get(),

                'total' => DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')
                ->join('pesanans', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                ->where('pesanans.status', 'Selesai')
                ->WhereMonth('tanggal', '=', $arrayBulanTahun[1])->whereYear('tanggal', '=', $arrayBulanTahun[0])
                ->select('produk.nama_produk', 'produk.modal', 'produk.harga', 'pesanandetails.jumlah')
                ->selectRaw('SUM(pesanandetails.jumlah) as jumlah_pesanan')
                ->selectRaw('SUM(pesanandetails.modal_details) as jumlah_modal')
                ->selectRaw('SUM(pesanandetails.jumlah_harga) as jumlah_harga')
                ->groupBy('produk.id_produk', 'produk.nama_produk', 'produk.modal', 'produk.harga', 'pesanandetails.jumlah')
                ->count(),

                'total_terjual' => DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')
                    ->join('pesanans', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                    ->where('pesanans.status', 'Selesai')
                    ->WhereMonth('tanggal', '=', $arrayBulanTahun[1])->whereYear('tanggal', '=', $arrayBulanTahun[0])
                    ->select('pesanans.status')
                    ->selectRaw('SUM(pesanandetails.jumlah) as jumlah_pesanan')
                    ->groupBy('pesanans.status')
                    ->first(),

                'total_modal' => DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')
                    ->join('pesanans', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                    ->where('pesanans.status', 'Selesai')
                    ->WhereMonth('tanggal', '=', $arrayBulanTahun[1])->whereYear('tanggal', '=', $arrayBulanTahun[0])
                    ->select('pesanans.status')
                    ->selectRaw('SUM(pesanandetails.modal_details) as jumlah_modal')
                    ->groupBy('pesanans.status')
                    ->first(),

                'total_harga' => DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')
                    ->join('pesanans', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                    ->where('pesanans.status', 'Selesai')
                    ->WhereMonth('tanggal', '=', $arrayBulanTahun[1])->whereYear('tanggal', '=', $arrayBulanTahun[0])
                    ->select('pesanans.status')
                    ->selectRaw('SUM(pesanandetails.jumlah_harga) as harga_terjual')
                    ->groupBy('pesanans.status')
                    ->first(),
            ]);
        }

        if (!empty($this->tahun)) {
            return view('export.laporanlabarugi', [
                'produk' => DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')
                ->join('pesanans', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                ->where('pesanans.status', 'Selesai')
                ->whereYear('pesanans.tanggal', $this->tahun)
                ->select('produk.nama_produk', 'produk.modal', 'produk.harga', 'pesanandetails.jumlah')
                ->selectRaw('SUM(pesanandetails.jumlah) as jumlah_pesanan')
                ->selectRaw('SUM(pesanandetails.modal_details) as jumlah_modal')
                ->selectRaw('SUM(pesanandetails.jumlah_harga) as jumlah_harga')
                ->groupBy('produk.id_produk', 'produk.nama_produk', 'produk.modal', 'produk.harga', 'pesanandetails.jumlah')
                ->get(),

            'total' => DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')
            ->join('pesanans', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
            ->where('pesanans.status', 'Selesai')
            ->whereYear('pesanans.tanggal', $this->tahun)
            ->select('produk.nama_produk', 'produk.modal', 'produk.harga', 'pesanandetails.jumlah')
            ->selectRaw('SUM(pesanandetails.jumlah) as jumlah_pesanan')
            ->selectRaw('SUM(pesanandetails.modal_details) as jumlah_modal')
            ->selectRaw('SUM(pesanandetails.jumlah_harga) as jumlah_harga')
            ->groupBy('produk.id_produk', 'produk.nama_produk', 'produk.modal', 'produk.harga', 'pesanandetails.jumlah')
            ->count(),

            'total_terjual' => DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')
                ->join('pesanans', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                ->where('pesanans.status', 'Selesai')
                ->whereYear('pesanans.tanggal', $this->tahun)
                ->select('pesanans.status')
                ->selectRaw('SUM(pesanandetails.jumlah) as jumlah_pesanan')
                ->groupBy('pesanans.status')
                ->first(),

            'total_modal' => DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')
                ->join('pesanans', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                ->where('pesanans.status', 'Selesai')
                ->whereYear('pesanans.tanggal', $this->tahun)
                ->select('pesanans.status')
                ->selectRaw('SUM(pesanandetails.modal_details) as jumlah_modal')
                ->groupBy('pesanans.status')
                ->first(),

            'total_harga' => DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')
                ->join('pesanans', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
                ->where('pesanans.status', 'Selesai')
                ->whereYear('pesanans.tanggal', $this->tahun)
                ->select('pesanans.status')
                ->selectRaw('SUM(pesanandetails.jumlah_harga) as harga_terjual')
                ->groupBy('pesanans.status')
                ->first(),
            ]);
        }
    }
}
