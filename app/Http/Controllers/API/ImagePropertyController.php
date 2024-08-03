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

        $propertyId = $validated['property_id'];
        $files = $request->file('images');

        $uploadedImages = [];

        foreach ($files as $file) {
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('images/properties', $fileName, 'public');

            // Pastikan property_id diisi dengan benar
            // dd($propertyId); // Cek apakah propertyId ada dan benar

            // Simpan informasi image ke database
            $imageProperty = ImageProperty::create([
                'property_id' => $propertyId,
                'image' => $filePath,
            ]);

            $uploadedImages[] = [
                'id' => $imageProperty->id,
                'property_id' => $imageProperty->property_id,
                'image' => $filePath,
                'created_at' => $imageProperty->created_at,
                'updated_at' => $imageProperty->updated_at,
            ];
        }

        return response()->json([
            'success' => true,
            'message' => 'Images uploaded successfully',
            'data' => $uploadedImages,
        ], 200);
    }
}
