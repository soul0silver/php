<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class EmpController extends \Illuminate\Routing\Controller
{
    public function index():JsonResponse{
        $data='abc';
        return response()->json($data);
}
}
