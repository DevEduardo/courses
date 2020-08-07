<?php

namespace Tests\Feature;

use App\Student;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class StudentDataIsRequiredTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;

    /** @test */
    function name_is_required()
    {
        $this->post('/students', [
            'name' => '',
            'lastName' => 'Saes',
            'age' => '34',
            'email' => 'eduardoargenis383@gmail.com',
            '_token' => session()->token()
        ])
        ->assertSessionHasErrors(['name']);
    }

    /** @test */
    function lastName_is_required()
    {
        $this->post('/students', [
            'name' => 'Eduardo',
            'lastName' => '',
            'age' => '34',
            'email' => 'eduardoargenis383@gmail.com',
            '_token' => session()->token()
        ])
        ->assertSessionHasErrors(['lastName']);
    }

    /** @test */
    function age_is_required()
    {
        $this->post('/students', [
            'name' => 'Eduardo',
            'lastName' => 'Saes',
            'age' => '',
            'email' => 'eduardoargenis383@gmail.com',
            '_token' => session()->token()
        ])
        ->assertSessionHasErrors(['age']);
    }

    function email_is_required()
    {
        $this->post('/students', [
            'name' => 'Eduardo',
            'lastName' => 'Saes',
            'age' => '',
            'email' => 'eduardoargenis383@gmail.com',
            '_token' => session()->token()
        ])
        ->assertSessionHasErrors(['email']);
    }
}
