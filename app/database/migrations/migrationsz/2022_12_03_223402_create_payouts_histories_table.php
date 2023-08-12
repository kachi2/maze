<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payouts_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref')->nullable();
            $table->integer('user_id')->nullable();
            $table->double('amount')->nullable();
            $table->double('prev_balance')->nullable();
            $table->double('avail_balance')->nullable();
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
        Schema::dropIfExists('payouts_histories');
    }
}
