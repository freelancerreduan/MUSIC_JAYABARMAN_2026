<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ActivityLog extends Model
{
    const UPDATED_AT = null;

    protected $fillable = ['user_id', 'action', 'subject_type', 'subject_label', 'ip'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function record(string $action, $subject = null, ?string $label = null): void
    {
        static::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'subject_type' => $subject ? Str::headline(class_basename($subject)) : null,
            'subject_label' => Str::limit($label ?? ($subject && method_exists($subject, 'activityLabel') ? $subject->activityLabel() : ''), 180),
            'ip' => request()->ip(),
        ]);
    }

    public function icon(): string
    {
        return match ($this->action) {
            'created' => 'plus-circle',
            'updated' => 'pencil-square',
            'deleted' => 'trash3',
            'login' => 'box-arrow-in-right',
            'logout' => 'box-arrow-right',
            default => 'activity',
        };
    }

    public function tone(): string
    {
        return match ($this->action) {
            'created' => 'green',
            'deleted' => 'red',
            'login', 'logout' => 'violet',
            default => 'blue',
        };
    }
}
