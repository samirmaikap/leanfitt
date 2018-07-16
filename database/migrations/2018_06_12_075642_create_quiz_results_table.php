<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_results', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->integer('lean_tool_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->float('score');
            $table->integer('correct')->default(0);
            $table->integer('incorrect')->default(0);
            $table->tinyInteger('is_completed')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('lean_tool_id')
                ->references('id')->on('lean_tools')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_results');
    }
}
