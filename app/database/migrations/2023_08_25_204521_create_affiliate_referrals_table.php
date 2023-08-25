<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_referrals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('agent_id')->unsigned();
            $table->integer('total_referrals')->nullable();
            $table->integer('traded_referrals')->nullable();
            $table->integer('active_referrals')->nullable();
            $table->integer('inactive_referrals')->nullable();
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
        Schema::dropIfExists('affiliate_referrals');
    }
}
