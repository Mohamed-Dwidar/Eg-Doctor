<?php

namespace Modules\ArticleModule\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Modules\ArticleModule\app\Models\Article;

class ArticleModuleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();
        DB::table('articles')->truncate();

    }
}
