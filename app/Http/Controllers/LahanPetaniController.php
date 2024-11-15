<?php

namespace App\Http\Controllers;

use App\Models\LahanPetani;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LahanPetaniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lahanPetani = LahanPetani::with(['user', 'wilayah'])->get();

        return response()->json([
            'message' => 'Lahan Petani found',
            'error' => null,
            'data' => $lahanPetani,
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
            'luas_lahan' => ['required', 'numeric'],
            'user_id' => ['required', 'exists:users,id'],
            'wilayah_id' => ['required', 'exists:wilayah,id'],
            'name' => ['required', 'string', 'max:255'],
            'lokasi' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            LahanPetani::create($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create Lahan Petani',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Lahan Petani created successfully',
            'error' => null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $lahanPetani = LahanPetani::with(['user', 'wilayah'])->find($id);

        if (!$lahanPetani) {
            return response()->json([
                'message' => 'Lahan Petani not found',
                'error' => null,
            ], 404);
        }

        return response()->json([
            'message' => 'Lahan Petani found',
            'error' => null,
            'data' => $lahanPetani,
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
            'luas_lahan' => ['required', 'numeric'],
            'user_id' => ['required', 'exists:users,id'],
            'wilayah_id' => ['required', 'exists:wilayah,id'],
            'name' => ['required', 'string', 'max:255'],
            'lokasi' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $lahanPetani = LahanPetani::findOrFail($id);
            $lahanPetani->update($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update Lahan Petani',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Lahan Petani updated successfully',
            'error' => null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $lahanPetani = LahanPetani::findOrFail($id);
            $lahanPetani->delete();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete Lahan Petani',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Lahan Petani deleted successfully',
            'error' => null,
        ]);
    }
}
