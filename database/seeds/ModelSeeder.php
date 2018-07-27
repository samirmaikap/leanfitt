<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name'=>'Test',
                'last_name'=>'admin',
                'email'=>'admin@example.com',
                'phone'=>'12345789',
                'password'=>'$2y$10$kqxiU3m4K2ihbBLQCvcP2.4iz7fOZS8A1dU.vXChosOI8Qx0M6Zze',
                'is_superadmin'=>1,
                'is_verified'=>1
            ],
        ]);



        /*LeanTool*/
        factory(\App\Models\LeanTool::class,10)->create();

        DB::table('report_categories')->insert([
            ['name'=>'Healthcare roadmap/gemba walk','description'=>'Sample description'],
            ['name'=>'Healthcare value strem map','description'=>'Sample description'],
            ['name'=>'Healthcare leadership','description'=>'Sample description'],
            ['name'=>'Healthcare standard work','description'=>'Sample description'],
            ['name'=>'Healthcare kaizen event','description'=>'Sample description'],
            ['name'=>'Healthcare quality tools','description'=>'Sample description'],
            ['name'=>'Healthcare 5s audit','description'=>'Sample description'],
            ['name'=>'Healthcare 6s audit','description'=>'Sample description'],
            ['name'=>'Healthcare A3 project report','description'=>'Sample description'],
            ['name'=>'Healthcare waste audit','description'=>'Sample description'],
            ['name'=>'Lean scatter plot','description'=>'Sample description'],
            ['name'=>'Lean run chart','description'=>'Sample description'],
            ['name'=>'Lean stakeholder analysis','description'=>'Sample description'],
            ['name'=>'Lean pareto chart','description'=>'Sample description'],
            ['name'=>'Lean histogram','description'=>'Sample description'],
            ['name'=>'Lean five whys analysis','description'=>'Sample description'],
            ['name'=>'Lean impact map','description'=>'Sample description'],
            ['name'=>'Lean brainstorming','description'=>'Sample description'],
            ['name'=>'Manufacturing 5s audit','description'=>'Sample description'],
            ['name'=>'Manufacturing 6s audit','description'=>'Sample description'],
            ['name'=>'Manufacturing waste audit','description'=>'Sample description'],
            ['name'=>'Manufacturing gemba walk','description'=>'Sample description'],
            ['name'=>'Manufacturing A3 project report','description'=>'Sample description'],
        ]);

    }
}
