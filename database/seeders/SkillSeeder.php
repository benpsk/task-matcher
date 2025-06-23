<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ['name' => 'Network'],
            ['name' => 'Camera'],
            ['name' => 'WiFi'],
            ['name' => 'Server'],
            ['name' => 'Hardware'],
            ['name' => 'Software'],
            ['name' => 'Security'],
            ['name' => 'Troubleshooting']
        ];
        DB::table('skills')->insert($skills);
    }
}
