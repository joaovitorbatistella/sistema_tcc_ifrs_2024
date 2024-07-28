<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\ClassTemplate;
use Illuminate\Support\Facades\Log;

class TemplateController extends Controller
{
    public function list(
        Request $request
    ): JsonResponse
    {
        try {
            $templates = ClassTemplate::select('class_template_uid', 'name')->get();

            return response()->json([
                "success"   => true,
                "data"      => $templates
            ]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                "success"   => false,
                "error"     => "Server error"
            ], 500);
        }
    }
}
