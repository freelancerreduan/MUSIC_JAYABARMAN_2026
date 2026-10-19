<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Affiliation extends Model
{
    use LogsActivity;

    protected $fillable = ['role', 'organization', 'url', 'sort_order'];

    public function activityLabel(): string
    {
        return $this->role;
    }
}
