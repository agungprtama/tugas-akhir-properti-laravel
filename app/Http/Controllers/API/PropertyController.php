<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\User;
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

    public function updateWithPost(Request $request, $id)
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

        $property = Property::findOrFail($id);

        // Pastikan user_id dari properti sesuai dengan id pengguna yang sedang terautentikasi
        if ($property->user_id !== Auth::id()) {
            // return response()->json(['error' => 'Forbidden'], 403);
            return ResponseFormatter::error(null, "Forbidden", 403);
        }

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

        // return response()->json($property, 200);
        return ResponseFormatter::success($property, 'Berhasil mendapatkan data property');
    }



    public function destroy($id)
    {
        try {
            $property = Property::findOrFail($id);
    
            // Pastikan user_id dari properti sesuai dengan id pengguna yang sedang terautentikasi
            if ($property->user_id !== Auth::id()) {
                return response()->json(['error' => 'Forbidden'], 403);
            }
    
            // Hapus gambar dari storage jika ada
            if ($property->image) {
                Storage::disk('public')->delete($property->image);
            }
    
            $property->delete();
            return response()->json(['message' => 'Berhasil menghapus data property'], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Tidak ada data property yang ditemukan'], 404);
        }
    }
    

    // public function userProperties(Request $request)
    // {
    //     // Validasi input
    //     // $validated = $request->validate([
    //     //     'user_id' => 'required|exists:users,id',
    //     // ]);

    //     // Ambil id user dari request
    //     $userId = $request->user_id;

    //     // Dapatkan data user berdasarkan id
    //     $user = User::find($userId);

    //     // Jika user tidak ditemukan, kembalikan error
    //     if (!$user) {
    //         return response()->json(['error' => 'User not found'], 404);
    //     }

    //     // Ambil properti yang dimiliki oleh user
    //     $properties = $user->properties;

    //     return ResponseFormatter::success($properties, 'Berhasil mendapatkan data property');
    // }

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
