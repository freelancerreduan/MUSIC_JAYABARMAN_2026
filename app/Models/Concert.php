<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use LogsActivity;

    protected $fillable = ['eyebrow', 'title', 'event_date', 'location', 'genres', 'excerpt', 'body', 'quote', 'image', 'is_featured', 'is_active'];

    protected $casts = ['event_date' => 'date', 'is_featured' => 'boolean', 'is_active' => 'boolean'];
}
