<?php

namespace Modules\Tag\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Tag\App\Models\TypedTag;

class TagDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypedTag::factory()->count(20)->create();
    }
}
