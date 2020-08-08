<?php

namespace Tests\Feature;

use App\Course;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CourseManagementTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;

    /** @test */
    function list_of_courses()
    {
        $this->withoutExceptionHandling();

        factory(Course::class, 3)->create();

        $courses =  Course::all();

        $response = $this->get('/courses');
        $response->assertOk();
        $response->assertViewIs('course.index');
        $response->assertViewHas('courses', $courses);
    }

    /** @test */
    function a_course_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/courses', [
            'name' => 'PHP',
            'schedule' => 'de 10:00 a 13:00',
            'starDate' => '2020-11-15',
            'endDate' => '2020-12-15',
            '_token' => session()->token()
        ]);

        $this->assertCount(1, Course::all());

        $course = Course::first();

        $this->assertEquals($course->name, 'PHP');
        $this->assertEquals($course->schedule, 'de 10:00 a 13:00');
        $this->assertEquals($course->starDate, '2020-11-15');
        $this->assertEquals($course->endDate, '2020-12-15');

        $response->assertRedirect('courses/');
    }

    /** @test */
    function a_course_can_be_retrieved()
    {
        $this->withoutExceptionHandling();

        $course = factory(Course::class)->create();

        $response = $this->get('courses/' . $course->id);
        $response->assertOk();

        $course = Course::first();

        $response->assertViewIs('course.show');
        $response->assertViewHas('course', $course);
    }

    /** @test */
    function a_course_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $course = factory(Course::class)->create();

        $response = $this->put('courses/' . $course->id, [
            'name' => 'PHP',
            'schedule' => 'de 10:00 a 13:00',
            'starDate' => '2020-11-15',
            'endDate' => '2020-12-15',
            '_token' => session()->token()
        ]);

        $this->assertCount(1, Course::all());

        $course = $course->fresh();

        $this->assertEquals($course->name, 'PHP');
        $this->assertEquals($course->schedule, 'de 10:00 a 13:00');
        $this->assertEquals($course->starDate, '2020-11-15');
        $this->assertEquals($course->endDate, '2020-12-15');

        $response->assertRedirect('courses/' . $course->id);
    }

    /** @test */
    function a_course_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $courses = factory(Course::class)->create();

        $response = $this->delete('courses/' . $courses->id);

        $this->assertCount(0, Course::all());

        $response->assertRedirect('courses/');
    }
}
