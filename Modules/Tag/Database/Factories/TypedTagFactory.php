<?php

namespace Modules\Tag\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Tag\Entities\TypedTag;

class TypedTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Tag\App\Models\TypedTag::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->word(),
            'type' => $this->faker->randomElement([TypedTag::TYPE_BLOG,TypedTag::TYPE_COURSE])
        ];
    }
}

