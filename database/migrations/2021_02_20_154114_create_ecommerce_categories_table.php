<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

class CreateEcommerceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerce_categories', function (Blueprint $table) {
            $table->id();

            $table->json('name')->nullable();
            $table->json('description')->nullable();
            $table->string('img_name')->nullable();
            $table->string('banner_name')->nullable();
            $table->integer('position')->unsigned()->default(0);
            //title and description in localeable table
            
            $table->decimal('sr_commission', 5, 2)->unsigned()->nullable();
            $table->decimal('shop_commission', 5, 2)->unsigned()->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('featured')->default(0);
            NestedSet::columns($table);
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
        Schema::dropIfExists('ecommerce_categories');
    }
}
