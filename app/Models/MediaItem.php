<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    use LogsActivity;

    protected $fillable = ['type', 'source', 'title', 'meta', 'embed_url', 'link_url', 'link_label', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    const TYPES = ['interview' => 'Interview', 'news' => 'News & Views'];
}
