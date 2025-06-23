<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = ['title', 'required_skill_id', 'urgency', 'duration', 'required_technicians'];

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class, 'required_skill_id');
    }

    public function assign_tasks(): HasMany
    {
        return $this->hasMany(AssignTask::class);
    }
}
