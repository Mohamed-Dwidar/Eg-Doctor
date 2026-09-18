<?php

namespace Modules\InformationModule\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Modules\InformationModule\app\Models\Information;

class InformationModuleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();
        DB::table('informations')->truncate();

    }
}
