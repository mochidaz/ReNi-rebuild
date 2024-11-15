<?php

namespace App\Http\Controllers;

use App\Models\InformasiSuhu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class InformasiSuhuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasiSuhu = InformasiSuhu::with('wilayah')->get();

        return response()->json([
            'message' => 'Informasi Suhu found',
            'error' => null,
            'data' => $informasiSuhu,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => ['required', 'string'],
            'wilayah_id' => ['required', 'exists:wilayah,id'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            InformasiSuhu::create($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create Informasi Suhu',
                'error' => $e->getMessage(),
            ], 400);
        }

        return response()->json([
            'message' => 'Informasi Suhu created successfully',
            'error' => null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $informasiSuhu = InformasiSuhu::with('wilayah')->find($id);

        if (!$informasiSuhu) {
            return response()->json([
                'message' => 'Informasi Suhu not found',
                'error' => null,
            ], 404);
        }

        return response()->json([
            'message' => 'Informasi Suhu found',
            'error' => null,
            'data' => $informasiSuhu,
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
            $informasiSuhu = InformasiSuhu::findOrFail($id);
            $informasiSuhu->update($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update Informasi Suhu',
                'error' => $e->getMessage(),
            ], 400);
        }

        return response()->json([
            'message' => 'Informasi Suhu updated successfully',
            'error' => null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $informasiSuhu = InformasiSuhu::findOrFail($id);
            $informasiSuhu->delete();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete Informasi Suhu',
                'error' => $e->getMessage(),
            ], 400);
        }

        return response()->json([
            'message' => 'Informasi Suhu deleted successfully',
            'error' => null,
        ]);
    }
}
