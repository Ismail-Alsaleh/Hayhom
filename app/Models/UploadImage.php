<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class UploadImage extends Model
{
    use HasTags;
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title', 'image'
    ];
}
