<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_stages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('agent_id')->nullable();
            $table->integer('campaign_id')->nullable();
            $table->integer('referrals')->nullable();
            $table->integer('status')->nullable();
            $table->double('commissions')->nullable();
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
        Schema::dropIfExists('campaign_stages');
    }
}
