<?php

namespace Modules\QuestionModule\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Modules\QuestionModule\app\Models\Question;

class QuestionModuleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();
        DB::table('questions')->truncate();

    }
}
