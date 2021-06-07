<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcommerceCatProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerce_cat_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id') //ecommerce_category_id
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('product_id') //ecommerce_product_id
                  ->unsigned()
                  ->nullable();
            $table->string('category_string') //Category tree in string
                  ->nullable();
            $table->bigInteger('addedby_id') //own id or other id
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('editedby_id') //own id or other id
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
        Schema::dropIfExists('ecommerce_cat_products');
    }
}
