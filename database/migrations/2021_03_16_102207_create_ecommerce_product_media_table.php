<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcommerceProductMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerce_product_media', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ecommerce_product_id')->unsigned()->nullable(); 
            $table->string('file_name')->nullable();
            $table->string('file_link')->nullable();
            $table->string('ext')->nullable();
            $table->string('mime')->nullable();
            $table->string('size')->nullable();
            $table->string('type')->nullable(); //image,video
            $table->bigInteger('addedby_id')->unsigned();
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
        Schema::dropIfExists('ecommerce_product_media');
    }
}
