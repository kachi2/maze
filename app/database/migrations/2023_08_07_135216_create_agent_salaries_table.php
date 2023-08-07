<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('agent_id');
            $table->double('amount')->nullable();
            $table->string('status')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('wallet_address')->nullable();
            $table->integer('is_approved')->nullable();
           $table->string('ref')->nullable();
            $table->string('details')->nullable();
            $table->dateTime('next_pay')->nullable();
            $table->double('prev_balance')->nullable();
            $table->double('avail_balance')->nullable();
            $table->double('total')->nullable();
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
        Schema::dropIfExists('agent_salaries');
    }
}
