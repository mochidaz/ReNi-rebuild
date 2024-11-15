<?php

namespace App\Http\Controllers;

use App\Models\ArtikelImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArtikelImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = ArtikelImage::with('artikel')->get();

        return response()->json([
            'message' => 'Artikel images found',
            'error' => null,
            'data' => $images,
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
        $validator = Validator::make($request->all(), [
            'artikel_id' => ['required', 'exists:articles,id'],
            'image' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            ArtikelImage::create($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create Artikel image',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Artikel image created successfully',
            'error' => null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $image = ArtikelImage::with('artikel')->find($id);

        if (!$image) {
            return response()->json([
                'message' => 'Artikel image not found',
                'error' => null,
            ], 404);
        }

        return response()->json([
            'message' => 'Artikel image found',
            'error' => null,
            'data' => $image,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'artikel_id' => ['required', 'exists:articles,id'],
            'image' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $image = ArtikelImage::findOrFail($id);
            $image->update($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update Artikel image',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Artikel image updated successfully',
            'error' => null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $image = ArtikelImage::findOrFail($id);
            $image->delete();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete Artikel image',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Artikel image deleted successfully',
            'error' => null,
        ]);
    }
}
