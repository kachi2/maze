<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanProfitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_profits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('plan_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->double('prev_balance')->nullable();
            $table->double('balance')->nullable();
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
        Schema::dropIfExists('plan_profits');
    }
}
