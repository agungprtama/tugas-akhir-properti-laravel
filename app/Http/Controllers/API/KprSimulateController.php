<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KprSimulateController extends Controller
{
    public function simulate(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'harga_properti' => 'required|numeric|min:0',
            'uang_muka' => 'required|numeric|min:0',
            'suku_bunga' => 'required|numeric|min:0',
            'jangka_waktu' => 'required|numeric|min:0',
        ]);

        // Ambil input dari request
        $hargaProperti = $validated['harga_properti'];
        $uangMuka = $validated['uang_muka'];
        $sukuBunga = $validated['suku_bunga'];
        $jangkaWaktu = $validated['jangka_waktu'];

        // Hitung jumlah pinjaman
        $jumlahPinjaman = $hargaProperti - $uangMuka;

        // Konversi suku bunga tahunan ke desimal dan hitung suku bunga bulanan
        $sukuBungaBulanan = ($sukuBunga / 100) / 12;

        // Hitung jumlah total pembayaran dalam bulan
        $jumlahPembayaran = $jangkaWaktu * 12;

        // Hitung angsuran bulanan menggunakan rumus anuitas
        $angsuranBulanan = $jumlahPinjaman * $sukuBungaBulanan * pow((1 + $sukuBungaBulanan), $jumlahPembayaran) / (pow((1 + $sukuBungaBulanan), $jumlahPembayaran) - 1);

        $angsuranBulananRupiah = 'Rp ' . number_format($angsuranBulanan, 2, ',', '.');
        $jumlahPinjamanRupiah = 'Rp ' . number_format($jumlahPinjaman, 2, ',', '.');
        $hargaPropertiRupiah = 'Rp ' . number_format($hargaProperti, 2, ',', '.');
        $uangMukaRupiah = 'Rp ' . number_format($uangMuka, 2, ',', '.');

        // Kembalikan hasil dalam format JSON
        // return response()->json([
        //     'angsuran_bulanan' => $angsuranBulananRupiah,
        //     'jumlah_pinjaman' => $jumlahPinjamanRupiah,
        //     'suku_bunga' => $sukuBunga . '%',
        //     'jangka_waktu' => $jangkaWaktu . ' tahun',
        //     'harga_properti' => $hargaPropertiRupiah,
        //     'uang_muka' => $uangMukaRupiah,
        // ]);
        return ResponseFormatter::success([
            'angsuran_bulanan' => $angsuranBulananRupiah,
            'jumlah_pinjaman' => $jumlahPinjamanRupiah,
            'suku_bunga' => $sukuBunga . '%',
            'jangka_waktu' => $jangkaWaktu . ' tahun',
            'harga_properti' => $hargaPropertiRupiah,
            'uang_muka' => $uangMukaRupiah,
        ], "Berhasil simulasi KPR");
    }
}
