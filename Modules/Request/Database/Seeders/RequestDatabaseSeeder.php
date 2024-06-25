<?php

namespace Modules\Request\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Request\App\Models\ConsultationRequest;
use Modules\Request\App\Models\CooperationRequest;

class RequestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConsultationRequest::factory(10)->create();
        CooperationRequest::factory(10)->create();
    }
}
