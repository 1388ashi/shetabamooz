<?php

namespace Modules\Home\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Home\App\Models\StudentPov;

class HomeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudentPov::factory(10)->create();
        // $this->call([]);
    }
}
