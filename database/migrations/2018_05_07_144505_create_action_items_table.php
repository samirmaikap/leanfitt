<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('process_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->tinyInteger('position');
            $table->date('due_date')->nullable();
            $table->tinyInteger('is_archived')->default(0);
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
        Schema::dropIfExists('action_items');
    }
}
