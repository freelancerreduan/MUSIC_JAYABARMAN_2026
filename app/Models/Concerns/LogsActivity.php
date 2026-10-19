<?php

namespace App\Models\Concerns;

use App\Models\ActivityLog;

/**
 * Writes a row to the activity log whenever an admin creates, updates or deletes the model.
 */
trait LogsActivity
{
    public static function bootLogsActivity(): void
    {
        foreach (['created', 'updated', 'deleted'] as $event) {
            static::$event(function ($model) use ($event) {
                if (! auth()->check()) {
                    return;
                }
                ActivityLog::record($event, $model);
            });
        }
    }

    public function activityLabel(): string
    {
        return (string) ($this->title ?? $this->name ?? $this->caption ?? $this->key ?? '#'.$this->getKey());
    }
}
