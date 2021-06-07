<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcommerceCatShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerce_cat_shops', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id') //ecommerce_shop_category_id
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('shop_id') //ecommerce_source_id
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('addedby_id') //own id or other id
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
        Schema::dropIfExists('ecommerce_cat_shops');
    }
}
