<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_commissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->bigInteger('order_item_id')->unsigned()->nullable();
            $table->bigInteger('shipment_id')->unsigned()->nullable();
            $table->bigInteger('shipment_item_id')->unsigned()->nullable();
            $table->bigInteger('agent_id')->unsigned()->nullable();
            $table->bigInteger('source_id')->unsigned()->nullable();
            $table->bigInteger('product_id')->unsigned()->nullable();
            
            $table->decimal('delivered_quantity', 13,2)->unsigned()->nullable();

            $table->decimal('total_price', 15, 2)->unsigned()->nullable();

            $table->decimal('sr_monthly_target', 15, 2)->unsigned()->nullable();

            $table->decimal('sr_commission', 5, 2)->unsigned()->nullable(); 
            // SR commission in percentage

            $table->decimal('sr_amount', 15, 2)->unsigned()->nullable(); 
            // SR commission Calculated amount

            $table->decimal('shop_commission', 5, 2)->unsigned()->nullable(); 
            // shop commission in percentage

            $table->decimal('shop_monthly_target', 15, 2)->unsigned()->nullable();

            $table->decimal('shop_amount', 15, 2)->unsigned()->nullable();
            // shop commission Calculated amount

            $table->decimal('system_balance', 15, 2)->unsigned()->nullable(); 
            // revenue for system

            $table->date('tr_date')->nullable();

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
        Schema::dropIfExists('sale_commissions');
    }
}
