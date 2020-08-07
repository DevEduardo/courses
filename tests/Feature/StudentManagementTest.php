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

    
}
