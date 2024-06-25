<?php

namespace Modules\Professor\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfessorFactory extends Factory
{
    protected $model = \Modules\Professor\App\Models\Professor::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'role' => $this->faker->name,
            'description' => $this->faker->text,
            'status' => random_int(0,1)

        ];
    }
}

