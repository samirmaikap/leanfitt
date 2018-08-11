<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GridSeeder extends Seeder
{

    public function run(){
        DB::table('grid_defaults')->insert([
            ['lean_tool_id'=>2,'name'=>'Test Title','statement'=>'Learn the importance and simplicity of 5S, utilize guidelines to ensure each part of 5S is complete, generate 5S progress reports, and learn from the case studies.'],
            ['lean_tool_id'=>2,'name'=>'Test Title','statement'=>'Learn the importance and simplicity of 5S, utilize guidelines to ensure each part of 5S is complete, generate 5S progress reports, and learn from the case studies.'],
            ['lean_tool_id'=>2,'name'=>'Test Title','statement'=>'Learn the importance and simplicity of 5S, utilize guidelines to ensure each part of 5S is complete, generate 5S progress reports, and learn from the case studies.'],
            ['lean_tool_id'=>2,'name'=>'Test Title','statement'=>'Learn the importance and simplicity of 5S, utilize guidelines to ensure each part of 5S is complete, generate 5S progress reports, and learn from the case studies.'],
            ['lean_tool_id'=>2,'name'=>'Test Title','statement'=>'Learn the importance and simplicity of 5S, utilize guidelines to ensure each part of 5S is complete, generate 5S progress reports, and learn from the case studies.'],
            ['lean_tool_id'=>2,'name'=>'Test Title','statement'=>'Learn the importance and simplicity of 5S, utilize guidelines to ensure each part of 5S is complete, generate 5S progress reports, and learn from the case studies.'],
            ['lean_tool_id'=>2,'name'=>'Test Title','statement'=>'Learn the importance and simplicity of 5S, utilize guidelines to ensure each part of 5S is complete, generate 5S progress reports, and learn from the case studies.'],
        ]);
    }
}
