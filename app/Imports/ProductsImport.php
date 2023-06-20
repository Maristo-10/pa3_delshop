<?php

namespace App\Imports;

use App\Models\KategoriProdukModel;
use App\Models\Produk;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;

class ProductsImport implements OnEachRow, WithStartRow
{
    public function onRow(Row $row)
    {
        $myFileName = "";
        $rowIndex = $row->getIndex();
        $rowData = $row->toArray();
        $namaProduk = $rowData[0];
        $harga = (int) $rowData[1];
        $jlhProduk = (int) $rowData[2];
        $deskripsi = $rowData[3];
        $role = $rowData[4];
        $kategori = $rowData[5];
        $ukuran = $rowData[6];
        $warna = $rowData[7];
        $angkatan = $rowData[8];
        $imageContents = "";
        $extension = "";

        $spreadsheet = IOFactory::load(request()->file('file'));
        $drawingCollection = $spreadsheet->getActiveSheet()->getDrawingCollection();
        $drawing = $drawingCollection[$rowIndex - 2]; // Adjust the index to match the row index

        if ($drawing instanceof MemoryDrawing) {
            ob_start();
            call_user_func(
                $drawing->getRenderingFunction(),
                $drawing->getImageResource()
            );
            $imageContents = ob_get_contents();
            ob_end_clean();
            switch ($drawing->getMimeType()) {
                case MemoryDrawing::MIMETYPE_PNG:
                    $extension = 'png';
                    break;
                case MemoryDrawing::MIMETYPE_GIF:
                    $extension = 'gif';
                    break;
                case MemoryDrawing::MIMETYPE_JPEG:
                    $extension = 'jpg';
                    break;
            }
        } else {
            $zipReader = fopen($drawing->getPath(), 'r');
            $imageContents = '';
            while (!feof($zipReader)) {
                $imageContents .= fread($zipReader, 1024);
            }
            fclose($zipReader);
            $extension = $drawing->getExtension();
        }

        $myFileName = Str::uuid()->toString() . '.' . $extension;
        file_put_contents('product-images/' . $myFileName, $imageContents);

        $existingProduct = Produk::where('nama_produk', $namaProduk)
            ->where('harga', $harga)
            ->where('deskripsi', $deskripsi)
            ->where('role_pembeli', $role)
            ->where('kategori_produk', $kategori)
            ->where('ukuran_produk', $ukuran)
            ->where('warna', $warna)
            ->where('angkatan', $angkatan)
            ->first();

        if ($existingProduct) {
            // If the product already exists, update its 'gambar_produk' field
            $existingProduct->gambar_produk = $myFileName;
            $existingProduct->save();
        } else {
            // If the product doesn't exist, create a new one
            $product = new Produk([
                'nama_produk' => $namaProduk,
                'harga' => $harga,
                'jumlah_produk' => $jlhProduk,
                'deskripsi' => $deskripsi,
                'role_pembeli' => $role,
                'kategori_produk' => $kategori,
                'ukuran_produk' => $ukuran,
                'warna' => $warna,
                'angkatan' => $angkatan,
                'gambar_produk' => $myFileName,
            ]);

            $product->save();
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
