<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class ArchiveItem extends Model
{
    use LogsActivity;

    protected $fillable = ['year', 'title', 'description', 'image', 'link', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
