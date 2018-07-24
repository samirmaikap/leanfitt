<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class ModelSeeder extends Seeder
{
    protected $faker;
    public function __construct()
    {
        $this->faker=new Faker();
    }

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
            ['name'=>'Healthcare roadmap/gemba walk','description'=>$this->faker->realText()],
            ['name'=>'Healthcare value strem map','description'=>$this->faker->realText()],
            ['name'=>'Healthcare leadership','description'=>$this->faker->realText()],
            ['name'=>'Healthcare standard work','description'=>$this->faker->realText()],
            ['name'=>'Healthcare kaizen event','description'=>$this->faker->realText()],
            ['name'=>'Healthcare quality tools','description'=>$this->faker->realText()],
            ['name'=>'Healthcare 5s audit','description'=>$this->faker->realText()],
            ['name'=>'Healthcare 6s audit','description'=>$this->faker->realText()],
            ['name'=>'Healthcare A3 project report','description'=>$this->faker->realText()],
            ['name'=>'Healthcare waste audit','description'=>$this->faker->realText()],
            ['name'=>'Lean scatter plot','description'=>$this->faker->realText()],
            ['name'=>'Lean run chart','description'=>$this->faker->realText()],
            ['name'=>'Lean stakeholder analysis','description'=>$this->faker->realText()],
            ['name'=>'Lean pareto chart','description'=>$this->faker->realText()],
            ['name'=>'Lean histogram','description'=>$this->faker->realText()],
            ['name'=>'Lean five whys analysis','description'=>$this->faker->realText()],
            ['name'=>'Lean impact map','description'=>$this->faker->realText()],
            ['name'=>'Lean brainstorming','description'=>$this->faker->realText()],
            ['name'=>'Manufacturing 5s audit','description'=>$this->faker->realText()],
            ['name'=>'Manufacturing 6s audit','description'=>$this->faker->realText()],
            ['name'=>'Manufacturing waste audit','description'=>$this->faker->realText()],
            ['name'=>'Manufacturing gemba walk','description'=>$this->faker->realText()],
            ['name'=>'Manufacturing A3 project report','description'=>$this->faker->realText()],
        ]);

    }
}
