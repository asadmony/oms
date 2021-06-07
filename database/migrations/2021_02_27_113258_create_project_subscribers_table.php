<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_subscribers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')
                  ->unsigned()
                  ->nullable();
            $table->string('subscription_code')->nullable();
            //pf code
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->integer('project_id') 
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('referral_id')
                  ->unsigned()
                  ->nullable();
                  //user id
            $table->boolean('pinned')->nullable()->default(false);
            $table->integer('drag_id')->unsigned()->nullable();
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
        Schema::dropIfExists('project_subscribers');
    }
}
