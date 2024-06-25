<?php

namespace Modules\Request\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ConsultationRequestFactory extends Factory
{
    protected $model = \Modules\Request\App\Models\ConsultationRequest::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->text(20),
            'mobile' => '09'.rand(000000000,999999999),
            'text' => $this->faker->text,
            'status' => $this->faker->boolean,
        ];
    }
}

