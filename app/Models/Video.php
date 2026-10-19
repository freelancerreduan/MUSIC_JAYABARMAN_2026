<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use LogsActivity;

    protected $fillable = ['title', 'title_bn', 'meta', 'body', 'credit', 'video_url', 'poster', 'in_project', 'in_performance', 'sort_order', 'is_active'];

    protected $casts = ['in_project' => 'boolean', 'in_performance' => 'boolean', 'is_active' => 'boolean'];

    /** True when the video is a YouTube/Facebook page instead of a playable file. */
    public function isExternal(): bool
    {
        return str_starts_with($this->video_url, 'http') && ! preg_match('/\.(mp4|webm|ogg|mov)(\?|$)/i', $this->video_url);
    }
}
