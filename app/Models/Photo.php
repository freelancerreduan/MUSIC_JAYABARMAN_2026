<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use LogsActivity;

    protected $fillable = ['image', 'caption', 'category', 'tag', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    const CATEGORIES = ['project' => 'Project page', 'portfolio' => 'Portfolio'];
}
