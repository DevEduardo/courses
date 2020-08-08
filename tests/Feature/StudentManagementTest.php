<?php

namespace Tests\Feature;

use App\Student;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class StudentManagementTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;

    /** @test */
    function list_of_students()
    {
        $this->withoutExceptionHandling();

        factory(Student::class, 3)->create();

        $students =  Student::all();

        $response = $this->get('/students');
        $response->assertOk();
        $response->assertViewIs('student.index');
        $response->assertViewHas('students', $students);
    }

    /** @test */
    function a_student_can_be_created()
    {
        $this->withoutExceptionHandling();

        $this->post('/students', [
            'name' => 'Eduardo',
            'lastName' => 'Saes',
            'age' => '34',
            'email' => 'eduardoargenis383@gmail.com',
            '_token' => session()->token()
        ])
            ->assertOk();

        $this->assertCount(1, Student::all());

        $student = Student::first();

        $this->assertEquals($student->name, 'Eduardo');
        $this->assertEquals($student->lastName, 'Saes');
        $this->assertEquals($student->age, '34');
        $this->assertEquals($student->email, 'eduardoargenis383@gmail.com');
    }

    /** @test */
    function a_student_can_be_retrieved()
    {
        //$this->withoutExceptionHandling();

        $student = factory(Student::class)->create();

        $response = $this->get('students/' . $student->id);
        $response->assertOk();

        $student = Student::first();

        $response->assertViewIs('student.show');
        $response->assertViewHas('student', $student);
    }
}
