<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignTask extends Model
{
    /** @use HasFactory<\Database\Factories\AssignTaskFactory> */
    use HasFactory;

    // add fillable
    //
    public function technician(): BelongsTo
    {
        return $this->belongsTo(Technician::class);
    }
}
