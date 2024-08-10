<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image_url' => 'required|image', // Validasi file gambar
            'link_url' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image_url')->store('uploads/banners', 'public/images'); // Upload file

        $banner = Banner::create([
            'title' => $request->title,
            'image_url' => $path, // Simpan path file
            'link_url' => $request->link_url,
        ]);

        return response()->json($banner);
    }

    public function index()
    {
        $banners = Banner::all();
        return response()->json($banners);
    }

    public function show($id)
    {
        $banner = Banner::findOrFail($id);
        return response()->json($banner);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image_url' => 'nullable|image', // Validasi file gambar
            'link_url' => 'nullable|string|max:255',
        ]);

        $banner = Banner::findOrFail($id);

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('uploads/banners', 'public/images'); // Upload file
            $banner->image_url = $path; // Update path file
        }

        $banner->update([
            'title' => $request->title,
            'link_url' => $request->link_url,
        ]);

        return response()->json($banner);
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return response()->json(null);
    }
}
