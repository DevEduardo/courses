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
    function name_is_string()
    {
        $this->post('/students', [
            'name' => 123456,
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
    function lastName_is_string()
    {
        $this->post('/students', [
            'name' => 'Eduardo',
            'lastName' => 1457,
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

    /** @test */
    function age_is_string()
    {
        $this->post('/students', [
            'name' => 'Eduardo',
            'lastName' => 'Saes',
            'age' => 12,
            'email' => 'eduardoargenis383@gmail.com',
            '_token' => session()->token()
        ])
        ->assertSessionHasErrors(['age']);
    }

    /** @test */
    function email_is_required()
    {
        $this->post('/students', [
            'name' => 'Eduardo',
            'lastName' => 'Saes',
            'age' => '32',
            'email' => '',
            '_token' => session()->token()
        ])
        ->assertSessionHasErrors(['email']);
    }

    /** @test */
    function email_is_email()
    {
        $this->post('/students', [
            'name' => 'Eduardo',
            'lastName' => 'Saes',
            'age' => '34',
            'email' => 'eduardoargenis383',
            '_token' => session()->token()
        ])
        ->assertSessionHasErrors(['email']);
    }
}
