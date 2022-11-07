<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{

    protected $fillable = [
        'coin',
        'usd',
        'brl',
        'effective_date',
    ];

}
