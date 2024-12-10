<?php

namespace Database\Seeders;

use App\Models\JobApplication;
use Database\Factories\JobApplicationFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobApplication::factory()->count(4)->create();
    }
}
