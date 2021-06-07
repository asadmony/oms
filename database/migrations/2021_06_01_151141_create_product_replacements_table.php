<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReplacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_replacements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('shipment_return_id')->unsigned()->nullable();
            $table->bigInteger('shipment_id')->unsigned()->nullable();
            $table->bigInteger('order_id')->unsigned()->nullable();
            
            $table->bigInteger('agent_id')->unsigned()->nullable();

            $table->bigInteger('source_id')->unsigned()->nullable();
            //optional (this time source is  shop or any)

            $table->string('mobile')->nullable();
            
            $table->text('address')->nullable();
            $table->text('reason')->nullable();
            $table->boolean('completed')->default(false);

            $table->string('return_status')->default('pending');

            $table->bigInteger('approvedby_id')->unsigned()->nullable();


            $table->decimal('total_quantity',10,2)->default(0);
            $table->decimal('total_price',10,2)->default(0);
            $table->decimal('total_weight',10,2)->default(0);
            $table->decimal('total_paid',10,2)->default(0);
            $table->decimal('total_due',10,2)->default(0);

            $table->decimal('total_shipment_price',15,2)->default(0);
            $table->decimal('total_return_price',15,2)->default(0);
            $table->decimal('total_replacement_price',15,2)->default(0);

            $table->timestamp('return_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('received_at')->nullable();

            $table->bigInteger('addedby_id')->unsigned()->nullable();
            $table->bigInteger('editedby_id')->unsigned()->nullable();
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
        Schema::dropIfExists('product_replacements');
    }
}
