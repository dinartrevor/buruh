<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaborRequest;
use App\Models\Labor;
use Illuminate\Http\JsonResponse;

class LaborController extends Controller
{
    public function update(LaborRequest $request, Labor $labor): JsonResponse
    {
        if ($request->ajax()) {
            try {
                $labor->update($request->validated());

                return response()->json([
                    'data' => $labor,
                    'message' => 'Data berhasil ditambahkan!',
                    'success' => true,
                ], JsonResponse::HTTP_OK);
            } catch (\Throwable $th) {
                return response()->json([
                    'data' => [],
                    'message' => $th->getMessage(),
                    'success' => false,
                ], $th->getCode());
            }
        }
    }
}
