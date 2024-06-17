<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        try {
            $artikel = Artikel::all();

            if ($artikel->isEmpty()) {
                return ResponseFormatter::error(null, "Tidak ada data artikel yang ditemukan", 404);
            }

            return ResponseFormatter::success($artikel, 'Berhasil mendapatkan data artikel');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Terjadi kesalahan saat mengambil data', $e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $artikel = Artikel::find($id);

            if (!$artikel) {
                return ResponseFormatter::error(null, "Artikel dengan ID $id tidak ditemukan", 404);
            }

            return ResponseFormatter::success($artikel, 'Berhasil mendapatkan data artikel');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Terjadi kesalahan saat mengambil data', $e->getMessage(), 500);
        }
    }
}
