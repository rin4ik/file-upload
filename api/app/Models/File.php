<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory;

    public static function booted() {
        static::creating(function($file) {
            $file->uuid = Str::uuid();
        });
        static::deleted(function ($file) { 
            Storage::disk('s3')->delete($file->path);
        });
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'size',
        'path',
        'name',
        'user_id'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = []; 
    
    public function links()
    {
        return $this->hasOne(FileLink::class);
    }
}
