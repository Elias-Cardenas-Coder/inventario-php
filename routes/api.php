<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/tokens', function (Request $request) {
        $request->validate([
            'device_name' => 'required|string',
        ]);

        $token = $request->user()->createToken($request->device_name);

        return response()->json([
            'plainTextToken' => $token->plainTextToken,
        ], 201);
    });

    Route::delete('/tokens/{id}', function (Request $request, $id) {
        $request->user()->tokens()->where('id', $id)->delete();

        return response()->json(['message' => 'Token deleted successfully']);
    });
});

