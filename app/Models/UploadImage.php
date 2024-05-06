<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadImage extends Model
{
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title', 'image'
    ];
}
