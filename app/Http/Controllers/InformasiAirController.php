<?php

namespace App\Http\Controllers;

use App\Models\InformasiAir;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InformasiAirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasiAir = InformasiAir::all();

        return response()->json([
            'message' => 'Informasi Air found',
            'error' => null,
            'data' => $informasiAir,
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

        if ($request->user()->role_id != 1) {
            return response()->json([
                'message' => 'You are not authorized to perform this action',
                'error' => null,
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'content' => ['required', 'string'],
            'wilayah_id' => ['required', 'exists:wilayah,id'], // Ensure wilayah_id exists in the Wilayah table
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            InformasiAir::create($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create Informasi Air',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Informasi Air created successfully',
            'error' => null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $informasiAir = InformasiAir::find($id);

        if (!$informasiAir) {
            return response()->json([
                'message' => 'Informasi Air not found',
                'error' => null,
            ], 404);
        }

        return response()->json([
            'message' => 'Informasi Air found',
            'error' => null,
            'data' => $informasiAir,
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
            'content' => ['required', 'string'],
            'wilayah_id' => ['required', 'exists:wilayah,id'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $informasiAir = InformasiAir::findOrFail($id);
            $informasiAir->update($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update Informasi Air',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Informasi Air updated successfully',
            'error' => null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $informasiAir = InformasiAir::findOrFail($id);
            $informasiAir->delete();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete Informasi Air',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Informasi Air deleted successfully',
            'error' => null,
        ]);
    }
}
