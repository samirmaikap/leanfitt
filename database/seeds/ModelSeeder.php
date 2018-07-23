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
            ['name'=>'Healthcare roadmap/gemba walk'],
            ['name'=>'Healthcare value strem map'],
            ['name'=>'Healthcare leadership'],
            ['name'=>'Healthcare standard work'],
            ['name'=>'Healthcare kaizen event'],
            ['name'=>'Healthcare quality tools'],
            ['name'=>'Healthcare 5s audit'],
            ['name'=>'Healthcare 6s audit'],
            ['name'=>'Healthcare A3 project report'],
            ['name'=>'Healthcare waste audit'],
            ['name'=>'Lean scatter plot'],
            ['name'=>'Lean run chart'],
            ['name'=>'Lean stakeholder analysis'],
            ['name'=>'Lean pareto chart'],
            ['name'=>'Lean histogram'],
            ['name'=>'Lean five whys analysis'],
            ['name'=>'Lean impact map'],
            ['name'=>'Lean brainstorming'],
            ['name'=>'Manufacturing 5s audit'],
            ['name'=>'Manufacturing 6s audit'],
            ['name'=>'Manufacturing waste audit'],
            ['name'=>'Manufacturing gemba walk'],
            ['name'=>'Manufacturing A3 project report'],
        ]);

    }
}
