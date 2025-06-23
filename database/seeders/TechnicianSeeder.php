<?php

namespace Database\Seeders;

use App\Models\Technician;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technicians = Technician::factory(10)->create();

        $technicians->each(function ($technician) {
            $skills = Skill::inRandomOrder()->take(3)->pluck('id');
            $technician->skills()->attach($skills);
        });
    }
}
