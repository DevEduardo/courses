<?php

namespace Tests\Feature;

use App\Course;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CourseDatalsRequiredTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;

    /** @test */
    function name_is_required()
    {
        $this->post('/courses', [
            'name' => '',
            'schedule' => 'de 10:00 a 14:00',
            'starDate' => '24/01/2021',
            'endDate' => '24/12/2020',
            '_token' => session()->token()
        ])
        ->assertSessionHasErrors(['name']);
    }

    /** @test */
    function name_is_string()
    {
        $this->post('/courses', [
            'name' => 1564,
            'schedule' => 'de 10:00 a 14:00',
            'starDate' => '24/01/2021',
            'endDate' => '24/12/2020',
            '_token' => session()->token()
        ])
        ->assertSessionHasErrors(['name']);
    }

    /** @test */
    function schedule_is_required()
    {
        $this->post('/courses', [
            'name' => 'PHP',
            'schedule' => '',
            'starDate' => '24/01/2021',
            'endDate' => '24/12/2020',
            '_token' => session()->token()
        ])
        ->assertSessionHasErrors(['schedule']);
    }

    /** @test */
    function schedule_is_string()
    {
        $this->post('/courses', [
            'name' => 'PHP',
            'schedule' => 1000,
            'starDate' => '24/01/2021',
            'endDate' => '24/12/2020',
            '_token' => session()->token()
        ])
        ->assertSessionHasErrors(['schedule']);
    }

    /** @test */
    function startDate_is_required()
    {
        $this->post('/courses', [
            'name' => 'PHP',
            'schedule' => 'de 10:00 a 14:00',
            'starDate' => '',
            'endDate' => '24/12/2020',
            '_token' => session()->token()
        ])
        ->assertSessionHasErrors(['starDate']);
    }

    /** @test */
    function startDate_is_string()
    {
        $this->post('/courses', [
            'name' => 'PHP',
            'schedule' => 'de 10:00 a 14:00',
            'starDate' => 24012021,
            'endDate' => '24/12/2020',
            '_token' => session()->token()
        ])
        ->assertSessionHasErrors(['starDate']);
    }
}
