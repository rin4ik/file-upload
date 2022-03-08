<?php

namespace App\Http\Controllers;

use App\Http\Resources\FileResource;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }
    public function index(Request $request)
    { 
        return FileResource::collection($request->user()->files);
    }
}
