<?php

namespace App\Http\Controllers\Api; 

use App\Http\Controllers\Controller;
use App\Models\FibonacciQuery;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class FibonacciController extends Controller
{
    public function calculate(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:100',
                'value' => 'required|integer|min:0|max:100',
            ]);

            $query = FibonacciQuery::create($validatedData);

            return response()->json([
                'name' => $query->name,
                'value' => $query->value,
                'result' => $query->result,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422); 
        } 
    }

}