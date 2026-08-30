<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_list_is_available(): void
    {
        Student::factory()->create(['name' => 'Ali Khan']);

        $this->get('/students')
            ->assertOk()
            ->assertSee('Ali Khan');
    }

    public function test_student_can_be_created(): void
    {
        $response = $this->post('/students', [
            'name' => 'Ali Khan',
            'email' => 'ali@example.com',
            'phone' => '03001234567',
            'course' => 'Flutter',
        ]);

        $response->assertRedirect('/students');
        $this->assertDatabaseHas('students', ['email' => 'ali@example.com']);
    }

    public function test_student_creation_requires_valid_data(): void
    {
        $response = $this->from('/students/create')->post('/students', [
            'name' => '',
            'email' => 'not-an-email',
            'course' => '',
        ]);

        $response->assertRedirect('/students/create')
            ->assertSessionHasErrors(['name', 'email', 'course']);
    }

    public function test_student_can_be_updated_without_changing_its_email(): void
    {
        $student = Student::factory()->create(['email' => 'ali@example.com']);

        $this->put("/students/{$student->id}", [
            'name' => 'Ali Updated',
            'email' => 'ali@example.com',
            'phone' => null,
            'course' => 'Laravel',
        ])->assertRedirect('/students');

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => 'Ali Updated',
            'email' => 'ali@example.com',
        ]);
    }

    public function test_student_can_be_deleted(): void
    {
        $student = Student::factory()->create();

        $this->delete("/students/{$student->id}")
            ->assertRedirect('/students');

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

    public function test_api_returns_student_json(): void
    {
        $student = Student::factory()->create(['name' => 'Ali Khan']);

        $this->getJson('/api/students/'.$student->id)
            ->assertOk()
            ->assertJsonPath('data.name', 'Ali Khan');
    }
}
