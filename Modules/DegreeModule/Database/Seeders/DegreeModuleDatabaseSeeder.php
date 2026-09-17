<?php

namespace Modules\DegreeModule\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Modules\DegreeModule\app\Models\Degree;

class DegreeModuleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();
        DB::table('degrees')->truncate();
        $arr_items = [
            ['name' => 'اخصائى', 'shortcut' => 'د'],
            ['name' => 'دكتور', 'shortcut' => 'د'],
            ['name' => 'أستاذ دكتور', 'shortcut' => 'أ.د'],
            ['name' => 'أستشارى', 'shortcut' => 'أ.د']
        ];
        Degree::insert($arr_items);
    }
}
