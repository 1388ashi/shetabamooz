<?php

namespace Modules\Course\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseRegisterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Course\App\Models\CourseRegister::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

