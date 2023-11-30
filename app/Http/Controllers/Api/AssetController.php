<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // menyimpan data dari tabel asset ke variabel $assets
        // dimana user_id = id user yang sedang login
        $assets = Asset::where('user_id', auth()->user()->id)->get();

        // mengembalikan data dalam bentuk json
        return response()->json([
            'success' => true,
            'data' => $assets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['image'] = $request->file('image')->store(
            'assets',
            'public'
        );

        $asset = Asset::create($data);

        return response()->json([
            'success' => true,
            'data' => $asset
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $asset = Asset::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $asset
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $asset = Asset::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store(
                'assets',
                'public'
            );
        }

        $asset->update($data);

        return response()->json([
            'success' => true,
            'data' => $asset
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // mencari asset berdasarkan id
        $asset = Asset::findOrFail($id);

        // menghapus asset
        $asset->delete();

        return response()->json([
            'success' => true,
            'message' => 'Asset berhasil dihapus'
        ]);
    }
}
