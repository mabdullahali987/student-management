<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Student::factory()->count(12)->create();
    }
}
