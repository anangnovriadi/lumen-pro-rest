<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model {
    protected $table = 'checklists';

    protected $fillable = [
        'type', 'description', 'object_domain',
        'object_id', 'is_completed', 'completed_at',
        'updated_by', 'due', 'urgency', 'self'
    ];
}