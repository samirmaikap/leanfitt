<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('avatar')->nullable();
            $table->string('password');
            $table->string('verification_token', 60)->default(md5(time()));
            $table->tinyInteger('is_verified')->default(0);
            $table->tinyInteger('is_superadmin')->default(0);
            $table->rememberToken();
            $table->string('api_token',60)->default(bin2hex(random_bytes(16)));
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
