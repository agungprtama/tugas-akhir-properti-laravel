<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil kategori dari query string
        $offerType = $request->query('offer_type');
        
        // Query untuk mendapatkan properti berdasarkan offer_type jika disediakan
        if ($offerType) {
            $properties = Property::where('offer_type', $offerType)->get();
        } else {
            $properties = Property::all();
        }

        // return response()->json($properties);
        return ResponseFormatter::success($properties, 'Berhasil mendapatkan data property');

    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'offer_type' => 'required|in:jual,sewa',
            'property_type' => 'required|in:rumah,apartement,tanah',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'furnished' => 'required|in:ya,tidak,semi',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'building_area' => 'required|integer',
            'land_area' => 'required|integer',
            'province' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'address' => 'required|string',
            'image' => 'nullable|image|max:2048', // validasi untuk gambar
            'gmaps_link' => 'nullable|url',
            'other_links' => 'nullable|url'
        ]);

        // Mengunggah gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('property', 'public');
        } else {
            $imagePath = null;
        }

        // Membuat properti
        $property = Property::create([
            ...$request->except('image'),
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        // return response()->json($property, 201);
        return ResponseFormatter::success($property, 'Berhasil mendapatkan data property');

    }

    public function show($id)
    {
        try {
            $property = Property::findOrFail($id);
            // return response()->json($property);
            return ResponseFormatter::success($property, 'Berhasil mendapatkan data property');
        } catch (ModelNotFoundException $e) {
            return ResponseFormatter::error(null, "Tidak ada data property yang ditemukan", 404);
        }
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        // dd($request->all());
        $request->validate([
            'offer_type' => 'required|in:jual,sewa',
            'property_type' => 'required|in:rumah,apartement,tanah',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'furnished' => 'required|in:ya,tidak,semi',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'building_area' => 'required|integer',
            'land_area' => 'required|integer',
            'province' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'address' => 'required|string',
            'image' => 'nullable|image|max:2048', // validasi untuk gambar
            'gmaps_link' => 'nullable|url',
            'other_links' => 'nullable|url'
        ]);

        $property = Property::findOrFail($id);

        // Mengunggah gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($property->image) {
                Storage::disk('public')->delete($property->image);
            }

            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $property->image;
        }

        // Memperbarui properti
        $property->update([
            ...$request->except('image'),
            'image' => $imagePath,
        ]);

        return response()->json($property, 200);
    }

    public function destroy($id)
    {
        

        try {
            $property = Property::findOrFail($id);
            $property->delete();
            // return response()->json(null, 204);
            return ResponseFormatter::success(null, 'Berhasil menghapus data property', 204);
        } catch (ModelNotFoundException $e) {
            return ResponseFormatter::error(null, "Tidak ada data property yang ditemukan", 404);
        }
    }

    public function userProperties()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $properties = $user->properties;
        return ResponseFormatter::success($properties, 'Berhasil mendapatkan data property');
    }
}
