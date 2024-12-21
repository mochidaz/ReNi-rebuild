<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Artikel::with('user')->get();

        return response()->json([
            'message' => 'Articles found',
            'error' => null,
            'data' => $articles,
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
        $request->merge([
            'user_id' => $request->user()->no_ktp
        ]);
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'string'],
            'category' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,no_ktp'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            Artikel::create($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create Article',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Article created successfully',
            'error' => null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $article = Artikel::with('user')->find($id);

        if (!$article) {
            return response()->json([
                'message' => 'Article not found',
                'error' => null,
            ], 404);
        }

        return response()->json([
            'message' => 'Article found',
            'error' => null,
            'data' => $article,
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

        $user = $request->user();
        if ($request->user()->role_id != 1) {
            return response()->json([
                'message' => 'You are not authorized to perform this action',
                'error' => null,
            ], 403);
        }
        $request->merge([
            'user_id' => $request->user()->no_ktp
        ]);

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'string'],
            'category' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,no_ktp'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $article = Artikel::findOrFail($id);
            $article->update($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update Article',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Article updated successfully',
            'error' => null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {

        if ($request->user()->role_id != 1) {
            return response()->json([
                'message' => 'You are not authorized to perform this action',
                'error' => null,
            ], 403);
        }

        try {
            $article = Artikel::findOrFail($id);
            $article->delete();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete Article',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'Article deleted successfully',
            'error' => null,
        ]);
    }
}
