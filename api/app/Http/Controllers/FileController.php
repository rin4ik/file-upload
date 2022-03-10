<?php

namespace App\Http\Controllers;

use App\Http\Resources\FileResource;
use Aws\S3\PostObjectV4;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function signed(Request $request)
    { 
        $filename = md5($request->name . microtime()) . '.' . $request->extension;  
        $object = new PostObjectV4(
            Storage::disk('s3')->getClient(),
            config('filesystems.disks.s3.bucket'),
            ['key' => 'files/' . $filename],
            [
                ['bucket' => config('filesystems.disks.s3.bucket')],
                ['starts-with', '$key', 'files/']
            ]
        );
        return response()->json([
            'attributes' => $object->getFormAttributes(),
            'additionalData' => $object->getFormInputs()
        ]);
    }
}
