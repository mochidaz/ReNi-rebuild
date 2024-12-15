<?php

namespace App\Http\Controllers;

use App\Models\InformasiTanah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class InformasiTanahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasiTanah = InformasiTanah::all();

        return response()->json([
            'message' => 'Informasi Tanah found',
            'error' => null,
            'data' => $informasiTanah,
        ]);
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
            'wilayah_id' => ['required', 'exists:wilayah,id'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            InformasiTanah::create($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create Informasi Tanah',
                'error' => $e->getMessage(),
            ], 400);
        }

        return response()->json([
            'message' => 'Informasi Tanah created successfully',
            'error' => null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $informasiTanah = InformasiTanah::with('wilayah')->find($id);

        if (!$informasiTanah) {
            return response()->json([
                'message' => 'Informasi Tanah not found',
                'error' => null,
            ], 404);
        }

        return response()->json([
            'message' => 'Informasi Tanah found',
            'error' => null,
            'data' => $informasiTanah,
        ]);
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
            $informasiTanah = InformasiTanah::findOrFail($id);
            $informasiTanah->update($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update Informasi Tanah',
                'error' => $e->getMessage(),
            ], 400);
        }

        return response()->json([
            'message' => 'Informasi Tanah updated successfully',
            'error' => null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $informasiTanah = InformasiTanah::findOrFail($id);
            $informasiTanah->delete();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete Informasi Tanah',
                'error' => $e->getMessage(),
            ], 400);
        }

        return response()->json([
            'message' => 'Informasi Tanah deleted successfully',
            'error' => null,
        ]);
    }
}
