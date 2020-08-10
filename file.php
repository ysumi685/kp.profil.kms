<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class file extends Model
{
    protected $fillable = [
        'name',
        'file_path'
    ];
}