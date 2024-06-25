<?php

namespace Modules\Course\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Course\App\Models\Course;

class CourseCommentFactory extends Factory
{

    protected $model = \Modules\Course\App\Models\CourseComment::class;


    public function definition(): array
    {
        return [
            'course_id' => Course::all()->random()->id,
            'name' => $this->faker->name,
            'mobile' => '09'.rand(000000000,999999999),
            'text' => $this->faker->text,
            'status' => random_int(0,1)
        ];
    }
}

