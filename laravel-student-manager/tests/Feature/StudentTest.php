<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_redirects_to_students(): void
    {
        $this->get('/')->assertRedirect(route('students.index'));
    }

    public function test_index_lists_and_searches_students(): void
    {
        Student::factory()->create(['name' => 'Anis Test']);
        Student::factory()->create(['name' => 'Other Person']);

        $this->get(route('students.index'))->assertOk()->assertSee('Anis Test')->assertSee('Other Person');

        $this->get(route('students.index', ['search' => 'Anis']))
            ->assertOk()->assertSee('Anis Test')->assertDontSee('Other Person');
    }

    public function test_student_can_be_created(): void
    {
        $this->post(route('students.store'), ['name' => 'Jean Dupont', 'age' => 22, 'email' => 'jean@example.com'])
            ->assertRedirect(route('students.index'));

        $this->assertDatabaseHas('students', ['email' => 'jean@example.com']);
    }

    public function test_invalid_student_is_rejected(): void
    {
        Student::factory()->create(['email' => 'taken@example.com']);

        $this->post(route('students.store'), ['name' => '', 'age' => 'abc', 'email' => 'taken@example.com'])
            ->assertSessionHasErrors(['name', 'age', 'email']);

        $this->assertDatabaseCount('students', 1);
    }

    public function test_student_show_page_works(): void
    {
        $student = Student::factory()->create();

        $this->get(route('students.show', $student))->assertOk()->assertSee($student->email);
    }

    public function test_student_can_be_updated_and_keep_own_email(): void
    {
        $student = Student::factory()->create();

        $this->put(route('students.update', $student), ['name' => 'New Name', 'age' => 25, 'email' => $student->email])
            ->assertRedirect(route('students.index'));

        $this->assertDatabaseHas('students', ['id' => $student->id, 'name' => 'New Name']);
    }

    public function test_student_can_be_deleted(): void
    {
        $student = Student::factory()->create();

        $this->delete(route('students.destroy', $student))->assertRedirect(route('students.index'));

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }
}
