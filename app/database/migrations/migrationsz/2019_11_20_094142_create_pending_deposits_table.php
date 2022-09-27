<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendingDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_deposits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref', 10);
            $table->double('token')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('plan_id')->unsigned();
            $table->double('amount');
            $table->double('fee')->default(0);
            $table->double('verifying_amount');
            $table->double('profit_rate');
            $table->string('payment_method');
            $table->tinyInteger('payment_period');
            $table->integer('duration');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('plan_id')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pending_deposits');
    }
}
