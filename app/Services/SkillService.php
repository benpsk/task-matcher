<?php

namespace App\Services;

use App\Models\Skill;

class SkillService
{
    public function get()
    {
        return Skill::all();
    }
}
