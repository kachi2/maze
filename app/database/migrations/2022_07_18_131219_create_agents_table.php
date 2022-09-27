<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{

    /**
     * Run the migrations.
     * @return void
     */


    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->integer('working_hours')->nullable();
            $table->integer('pay_day')->default(14);
            $table->dateTime('email_verify')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->string('login_ip')->nullable();
            $table->timestamps();
        });
    }


    /*
     * Reverse the migrations.
     * @return void
     */

    public function down()
    {
        Schema::dropIfExists('agents');
    }


}
