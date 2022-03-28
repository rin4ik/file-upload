<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Str;

class FileLinkController extends Controller
{
    public function store(Request $request, File $file)
    {
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
