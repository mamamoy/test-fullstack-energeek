<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jobs')->insert([
            [
                'name' => 'Frontend Developer',
                'created_at' => now(),
            ],
            [
                'name' => 'Backend Developer',
                'created_at' => now(),
            ],
            [
                'name' => 'Fullstack Developer',
                'created_at' => now(),
            ],
            [
                'name' => 'UI/UX Designer',
                'created_at' => now(),
            ],
            [
                'name' => 'Marketing',
                'created_at' => now(),
            ],
            [
                'name' => 'Maintenance',
                'created_at' => now(),
            ],
        ]);
    }
}
