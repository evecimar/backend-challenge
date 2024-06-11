<?php

namespace App\Http\Controllers\Api; 

use App\Http\Controllers\Controller;
use App\Models\FibonacciQuery;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class FibonacciController extends Controller
{
    // Faz calculo de fibonacci de acordo com o valor passado
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

    // Mostrar todas as consultas de fibonacci
    public function index(Request $request): JsonResponse
    {
        $queries = FibonacciQuery::query();

        if ($request->has('name')) {
            $queries->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('value')) {
            $queries->where('value', $request->input('value'));
        }

        return response()->json($queries->get());
    }

    // Mostra uma consulta especifica do calculo feito
    public function show(FibonacciQuery $query): JsonResponse
    {   
        return response()->json([
            'name' => $query->name,
            'value' => $query->value,
            'result' => $query->result,
        ]);
    }

    // Faz update completo de uma consulta especifica do calculo feito
    public function update(Request $request, FibonacciQuery $query): JsonResponse
    {
    
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:100',
                'value' => 'required|integer|min:0|max:100',
            ]);

            $query->update($validatedData);

            $query->result = $query->calculateFibonacci();
            $query->save();

            return response()->json($query);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    // Faz update parcial de uma consulta especifica do calculo feito
    public function partialUpdate(Request $request, FibonacciQuery $query): JsonResponse
    {
        try {
            $rules = [];
            if ($request->has('name')) {
                $rules['name'] = 'string|max:100';
            }
            if ($request->has('value')) {
                $rules['value'] = 'integer|min:0|max:100';
            }
            $validatedData = $request->validate($rules);

            $query->update($validatedData);

            if ($request->has('value')) {
                $query->result = $query->calculateFibonacci();
                $query->save();
            }

            return response()->json($query);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        }
    }
    
    // Deleta uma consulta especifica do calculo feito
    public function destroy(FibonacciQuery $query): JsonResponse
    {
        $query->delete();
        return response()->json(['message' => 'Fibonacci query deleted successfully']);
    }
}