<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyPhone extends Model
{
    protected $table = 'phones';
    protected $primaryKey ='id';
    protected $fillable = [
        'phone'
    ];
}
