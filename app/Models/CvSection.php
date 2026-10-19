<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class CvSection extends Model
{
    use LogsActivity;

    protected $fillable = ['title', 'icon', 'column', 'sort_order'];

    public function blocks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CvBlock::class)->orderBy('sort_order')->orderBy('id');
    }
}
