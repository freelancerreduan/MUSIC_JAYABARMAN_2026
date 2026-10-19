<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class CvBlock extends Model
{
    use LogsActivity;

    protected $fillable = ['cv_section_id', 'heading', 'type', 'content', 'sort_order'];

    const TYPES = ['timeline' => 'List with years', 'chips' => 'Small tags', 'text' => 'Paragraph', 'links' => 'Website links'];

    public function section(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CvSection::class, 'cv_section_id');
    }

    /** Non-empty lines of the content field. */
    public function lines(): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\r?\n/', (string) $this->content))));
    }

    /** Splits 'left | right' lines; a line without '|' gives [null, line]. */
    public function pairs(): array
    {
        return array_map(function ($line) {
            $parts = array_map('trim', explode('|', $line, 2));
            return count($parts) === 2 ? $parts : [null, $parts[0]];
        }, $this->lines());
    }

    public function activityLabel(): string
    {
        return $this->heading ?: ($this->section->title ?? 'CV block');
    }
}
