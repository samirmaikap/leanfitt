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
    }
}
