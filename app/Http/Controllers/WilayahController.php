<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWilayahRequest;
use App\Http\Requests\UpdateWilayahRequest;
use App\Models\Wilayah;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wilayah = Wilayah::all();

        return response()->json([
            'message' => 'Wilayah found',
            'error' => null,
            'data' => $wilayah,
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
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            Wilayah::create($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create Wilayah',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Wilayah created successfully',
            'error' => null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $wilayah = Wilayah::find($id);

        if (!$wilayah) {
            return response()->json([
                'message' => 'Wilayah not found',
                'error' => null,
            ], 404);
        }

        return response()->json([
            'message' => 'Wilayah found',
            'error' => null,
            'data' => $wilayah,
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
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $wilayah = Wilayah::findOrFail($id);
            $wilayah->update($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update Wilayah',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Wilayah updated successfully',
            'error' => null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $wilayah = Wilayah::findOrFail($id);
            $wilayah->delete();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete Wilayah',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Wilayah deleted successfully',
            'error' => null,
        ]);
    }
}
