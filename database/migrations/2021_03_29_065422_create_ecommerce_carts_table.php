<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcommerceCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerce_carts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')
                  ->unsigned() //custome id
                  ->nullable();
            $table->bigInteger('product_id')
                  ->unsigned()
                  ->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->text('cookie')->nullable();
            $table->integer('quantity')->unsigned()->default(1);
                        
            $table->bigInteger('addedby_id')
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('editedby_id')
                  ->unsigned()
                  ->nullable();
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
        Schema::dropIfExists('ecommerce_carts');
    }
}
