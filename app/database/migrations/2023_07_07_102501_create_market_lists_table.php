<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketListsTable extends Migration
{
/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('symbol')->nullable();
            $table->string('image')->nullable();
            $table->string('current_price')->nullable();
            $table->string('price_change_24h')->nullable();
            $table->string('price_change_percentage_24h')->nullable();
            $table->string('market_cap_change_24h')->nullable();
            $table->string('market_cap_change_percentage_24h')->nullable();
            $table->string('market_cap')->nullable();
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
        Schema::dropIfExists('market_lists');
    }
}
