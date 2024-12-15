<?php

namespace App\Http\Controllers;

use App\Models\Pangan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pangan = Pangan::all();

        return response()->json([
            'message' => 'Pangan found',
            'error' => null,
            'data' => $pangan,
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
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            Pangan::create($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create Pangan',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Pangan created successfully',
            'error' => null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $pangan = Pangan::find($id);

        if (!$pangan) {
            return response()->json([
                'message' => 'Pangan not found',
                'error' => null,
            ], 404);
        }

        return response()->json([
            'message' => 'Pangan found',
            'error' => null,
            'data' => $pangan,
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
            $pangan = Pangan::findOrFail($id);
            $pangan->update($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update Pangan',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Pangan updated successfully',
            'error' => null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $pangan = Pangan::findOrFail($id);
            $pangan->delete();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete Pangan',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Pangan deleted successfully',
            'error' => null,
        ]);
    }
}
