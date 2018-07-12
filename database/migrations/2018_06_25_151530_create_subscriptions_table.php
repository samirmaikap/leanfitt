<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
//            $table->increments('id')->index();
//            $table->integer('employee_id')->unsigned();
//            $table->string('gateway_id');
//            $table->tinyInteger('is_active')->default(0);
//            $table->timestamps();
//            $table->foreign('employee_id')
//                ->references('id')->on('employees')
//                ->onDelete('cascade');

            $table->increments('id');
            $table->unsignedInteger('organization_id');
            $table->string('name');
            $table->string('stripe_id');
            $table->string('stripe_plan');
            $table->integer('quantity');
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
