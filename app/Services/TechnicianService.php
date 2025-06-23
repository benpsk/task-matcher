<?php

namespace App\Services;

use App\Models\Technician;

class TechnicianService
{
    public function store(array $input)
    {
        $tech = Technician::create($input);
        $tech->skills()->attach($input['skill_ids']);
    }
}
