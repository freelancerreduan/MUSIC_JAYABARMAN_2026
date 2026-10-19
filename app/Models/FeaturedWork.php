<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class FeaturedWork extends Model
{
    use LogsActivity;

    protected $fillable = ['title', 'source', 'image', 'image_position', 'link', 'is_bangla', 'sort_order', 'is_active'];

    protected $casts = ['is_bangla' => 'boolean', 'is_active' => 'boolean'];
}
