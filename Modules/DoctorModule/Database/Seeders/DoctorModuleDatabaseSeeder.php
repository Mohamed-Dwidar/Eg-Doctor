<?php

namespace Modules\DoctorModule\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Modules\DoctorModule\app\Models\Doctor;

class DoctorModuleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();
        DB::table('doctors')->truncate();

    }
}
