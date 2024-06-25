<?php

namespace Modules\Admin\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Core\Helpers\Helpers;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Admin\App\Models\Admin::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'mobile' => '0911' . Helpers::randomNumbersCode(7),
            'password' => bcrypt('secret'),
            'status' => 1,
            'remember_token' => Str::random(10),
        ];
    }
}

