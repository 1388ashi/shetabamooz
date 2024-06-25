<?php

namespace Modules\Request\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CooperationRequestFactory extends Factory
{
    protected $model = \Modules\Request\App\Models\CooperationRequest::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->text(20),
            'mobile' => '09'.rand(000000000,999999999),
            'email' => $this->faker->email,
            'resume' => $this->faker->text,
            'status' => $this->faker->boolean,

        ];
    }
}

