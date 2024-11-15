<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userData = UserData::all();

        return response()->json([
            'message' => 'User data found',
            'error' => null,
            'data' => $userData,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:15'],
            'profile_photo' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            UserData::create($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create user data',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'User data created successfully',
            'error' => null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $userData = UserData::find($id);

        if (!$userData) {
            return response()->json([
                'message' => 'User data not found',
                'error' => null,
            ], 404);
        }

        return response()->json([
            'message' => 'User data found',
            'error' => null,
            'data' => $userData,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:15'],
            'profile_photo' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $userData = UserData::findOrFail($id);
            $userData->update($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update user data',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'User data updated successfully',
            'error' => null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $userData = UserData::findOrFail($id);
            $userData->delete();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete user data',
                'error' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'message' => 'User data deleted successfully',
            'error' => null,
        ]);
    }
}
