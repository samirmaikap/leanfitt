<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organization_user_id')->unsigned();
            $table->integer('communication')->default(1);
            $table->integer('enthusiasm')->default(1);
            $table->integer('participation')->default(1);
            $table->integer('quality_work')->default(1);
            $table->integer('dependability')->default(1);
            $table->longText('remark')->nullable();
            $table->integer('evaluated_by')->unsigned();
            $table->timestamps();
            $table->foreign('evaluated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('organization_user_id')->references('id')->on('organization_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
