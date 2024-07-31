<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ImageProperty;
use Illuminate\Http\Request;

class ImagePropertyController extends Controller
{
    public function uploadImages(Request $request)
    {
        // Validasi request
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Mengambil property_id dari request
        $propertyId = $validated['property_id'];

        // Mengambil file images dari request
        $files = $request->file('images');

        $uploadedImages = [];

        // Proses setiap file image
        foreach ($files as $file) {
            // Generate nama unik untuk file
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke direktori yang diinginkan
            $filePath = $file->storeAs('images/properties', $fileName, 'public');

            // Simpan informasi image ke database
            $imageProperty = ImageProperty::create([
                'property_id' => $propertyId,
                'image' => $filePath,
            ]);

            // Simpan data yang diupload ke dalam array
            $uploadedImages[] = $imageProperty;
        }

        // Mengembalikan response sukses dengan data image yang diupload
        return response()->json([
            'success' => true,
            'message' => 'Images uploaded successfully',
            'data' => $uploadedImages,
        ], 200);
    }
}
