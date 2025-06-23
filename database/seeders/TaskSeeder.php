<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 20) as $index) {
            $skill = Skill::all()->random()->id;
            Task::factory()
                ->create([
                    'required_skill_id' => $skill
                ]);
        }
    }
}
