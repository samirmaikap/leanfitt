<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GridSeeder extends Seeder
{

    public function run(){
        DB::table('grid_defaults')->insert([
            ['name'=>'5S','description'=>'Learn the importance and simplicity of 5S, utilize guidelines to ensure each part of 5S is complete, generate 5S progress reports, and learn from the case studies.'],
        ]);
    }
}