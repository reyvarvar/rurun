<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FunRun extends Model
{
    protected $table = 'fun_run';

    protected $fillable = [
        'rute',
        'jarak',
        'elevasi',
        'keramaian',
        'gambar',
    ];

    public $timestamps = false;
}

