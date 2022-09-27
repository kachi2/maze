<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->text('name')->nullable();
            $table->text('rules')->nullable();
            $table->double('reward')->nullable();
            $table->string('image')->nullable();
            $table->integer('is_completed')->default(0);
            $table->integer('is_clicked')->default(0);
            $table->double('metrics')->nullable();
            $table->integer('admin_approval')->default(0);
            $table->dateTime('expires')->nullable();
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
        Schema::dropIfExists('task_campaigns');
    }
}
