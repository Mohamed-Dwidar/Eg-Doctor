<?php

namespace Modules\VideoModule\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Modules\VideoModule\app\Models\Video;

class VideoModuleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();
        DB::table('videos')->truncate();

    }
}
