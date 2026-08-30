<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->optional()->numerify('03#########'),
            'course' => fake()->randomElement(['Flutter', 'Laravel', 'React', 'Node.js', 'Software Engineering']),
        ];
    }
}
