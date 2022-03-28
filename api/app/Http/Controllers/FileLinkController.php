<?php

namespace App\Http\Controllers;

use App\Http\Resources\FileResource;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only('store');
    }
    public function show(Request $request, File $file)
    {
        $file = File::whereUuid($file->uuid)->whereHas('links', function($query) use ($request){
            $query->where('token', $request->token);
        })->first();
        return (new FileResource($file))->additional([
            'meta' => [
                'url' => Storage::disk('s3')->temporaryUrl(
                    $file->path,
                    now()->addHours(2),
                    [
                        'ResponseContentType' => 'application/octet-stream',
                        'ResponseContentDisposition' => 'attachment; filename=' . $file->name
                    ]
                )
            ]
        ]);
    }
    public function store(Request $request, File $file)
    {
        $this->authorize('create-link', $file);
        $link = $file->links()->firstOrCreate([], [
            'token' => hash_hmac('sha256', Str::random(40), $file->uuid)
        ]);
        return [
            'data' => [
                'url' => 'http://localhost:8080/download/' . $file->uuid . '?token=' . $link->token
            ]
        ];
    }
}
