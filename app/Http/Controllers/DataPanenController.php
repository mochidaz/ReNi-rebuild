<?php

namespace App\Http\Controllers;

use App\Models\DataPanen;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataPanenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $dataPanen = DataPanen::with(['pangan', 'user', 'lahan'])->where('user_id', $user->no_ktp)->get();

        return response()->json([
            'message' => 'Data Panen found',
            'error' => null,
            'data' => $dataPanen,
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
            'tanggal_penanaman' => ['required', 'date'],
            'tanggal_panen' => ['required', 'date'],
            'pangan_id' => ['required', 'exists:pangan,id'],
            'hasil_panen' => ['required', 'numeric'],
            'lahan_id' => ['required', 'exists:lahan_petani,id'],
        ]);

        $request->merge([
            'user_id' => $request->user()->no_ktp
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            DataPanen::create($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create Data Panen',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Data Panen created successfully',
            'error' => null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $dataPanen = DataPanen::with(['pangan', 'user', 'lahan', 'dataPanenImage'])->find($id);

        if (!$dataPanen) {
            return response()->json([
                'message' => 'Data Panen not found',
                'error' => null,
            ], 404);
        }

        return response()->json([
            'message' => 'Data Panen found',
            'error' => null,
            'data' => $dataPanen,
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
            'tanggal_penanaman' => ['required', 'date'],
            'tanggal_panen' => ['required', 'date'],
            'pangan_id' => ['required', 'exists:pangan,id'],
            'user_id' => ['required', 'exists:users,id'],
            'hasil_panen' => ['required', 'numeric'],
            'lahan_id' => ['required', 'exists:lahan_petani,id'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $dataPanen = DataPanen::findOrFail($id);
            $dataPanen->update($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update Data Panen',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Data Panen updated successfully',
            'error' => null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $dataPanen = DataPanen::findOrFail($id);
            $dataPanen->delete();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete Data Panen',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Data Panen deleted successfully',
            'error' => null,
        ]);
    }
}
