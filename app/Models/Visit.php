<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    const UPDATED_AT = null;

    protected $fillable = ['visited_on', 'path', 'visitor', 'referrer'];

    protected $casts = ['visited_on' => 'date'];
}
