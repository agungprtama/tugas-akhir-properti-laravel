<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::with('owner', 'category')->get();
        return response()->json(['venues' => $venues], 200);
    }

    public function store(Request $request)
    {
        $venue = Venue::create($request->all());
        return response()->json(['venue' => $venue], 201);
    }

    public function show($id)
    {
        $venue = Venue::with('owner', 'category')->findOrFail($id);
        return response()->json(['venue' => $venue], 200);
    }

    public function update(Request $request, $id)
    {
        $venue = Venue::findOrFail($id);
        $venue->update($request->all());
        return response()->json(['venue' => $venue], 200);
    }

    public function destroy($id)
    {
        $venue = Venue::findOrFail($id);
        $venue->delete();
        return response()->json(null, 204);
    }

    public function showbyCategoryId(Request $request)
    {
        $categoryId = $request->category_id;

        // Jika category ID disediakan, filter venue berdasarkan kategori
        if ($categoryId) {
            $venues = Venue::with('owner', 'category')
                ->where('category_id', $categoryId)
                ->get();
        } else {
            // Jika tidak ada category ID, kembalikan semua venue
            $venues = Venue::with('owner', 'category')->get();
        }

        return response()->json(['venues' => $venues], 200);
    }
}
