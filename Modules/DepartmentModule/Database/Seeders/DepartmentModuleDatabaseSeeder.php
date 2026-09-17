<?php

namespace Modules\DepartmentModule\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Modules\DepartmentModule\app\Models\Department;

class DepartmentModuleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();
        DB::table('departments')->truncate();
        Department::create(['name' => 'Professional Development & BI-infused CRM']);
        Department::create(['name' => 'Mobile Applications Development (Native)']);
        Department::create(['name' => 'Software Testing & Quality Assurance']);
        Department::create(['name' => 'Web & User Interface Development']);
        Department::create(['name' => 'Telecom Applications Development']);
        Department::create(['name' => 'Architecture, Engineering, and Construction Informatics']);
        Department::create(['name' => 'Artificial Intelligence & Machine Learning']);
        Department::create(['name' => 'Open-Source Applications Development']);
        Department::create(['name' => 'Cloud Platform Development']);
        Department::create(['name' => 'Enterprise & Web Apps Development – Java']);
        Department::create(['name' => 'Integrated Software Development & Architecture']);
        Department::create(['name' => 'Mobile Application Development (Cross-Platform)']);
        Department::create(['name' => 'Data Management']);
        Department::create(['name' => 'Data Science']);
        Department::create(['name' => 'ERP Consulting']);
        Department::create(['name' => 'Geoinformatics (GIS)']);
    }
}
