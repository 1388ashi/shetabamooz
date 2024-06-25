<?php

namespace Modules\Home\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentPovFactory extends Factory
{
    protected $model = \Modules\Home\App\Models\StudentPov::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'comment' => $this->faker->text
        ];
    }
}

