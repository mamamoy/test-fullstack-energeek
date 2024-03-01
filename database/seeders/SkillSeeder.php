<?php

namespace Database\Seeders;

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
        DB::table('skills')->insert([
            [
                'name' => 'Php',
                'created_at' => now(),
            ],
            [
                'name' => 'Python',
                'created_at' => now(),
            ],
            [
                'name' => 'Laravel',
                'created_at' => now(),
            ],
            [
                'name' => 'Javascript',
                'created_at' => now(),
            ],
            [
                'name' => 'MySQL',
                'created_at' => now(),
            ],
            [
                'name' => 'CSS',
                'created_at' => now(),
            ],
            [
                'name' => 'TailwindCSS',
                'created_at' => now(),
            ],
        ]);
    }
}
