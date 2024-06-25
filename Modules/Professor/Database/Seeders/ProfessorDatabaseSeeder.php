<?php

namespace Modules\Professor\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Professor\App\Models\Professor;

class ProfessorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Professor::factory(10)->create();
        // $this->call([]);
    }
}
