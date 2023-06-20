<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LaporanPejualanMultiple implements WithMultipleSheets
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

    public function sheets(): array
    {
        $sheets = [];
        $sheets[0] = new LaporanPenjualanExport($this->awal, $this->akhir,$this->bulan, $this->tahun);
        $sheets[1] = new LaporanPendapatanExport($this->awal, $this->akhir,$this->bulan, $this->tahun);
        return $sheets;
    } //
}
