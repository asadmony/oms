<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('shipment_id')->unsigned()->nullable();
            $table->bigInteger('order_id')->unsigned()->nullable();
            //ecommerce_order_id
            $table->bigInteger('order_item_id')->unsigned()->nullable();

            $table->bigInteger('product_id')->unsigned()->nullable();
            //ecommerce_product_id
            //
            $table->json('product_name')->nullable();

            $table->bigInteger('user_id')->unsigned()->nullable();
            //customer user_id

            $table->bigInteger('seller_source_id')->unsigned()->nullable();
            //ecommerce_source_id //this time seller

            $table->bigInteger('buyer_source_id')->unsigned()->nullable();
            //optional (this time source is buyer shop or any)
            //ecommerce_source_id //this time buyer


            ## ordered product area depo distri.....
            $table->bigInteger('depo_id')->unsigned()->nullable();
            $table->bigInteger('distributor_id')->unsigned()->nullable();
            $table->bigInteger('dealer_id')->unsigned()->nullable();
            $table->bigInteger('agent_id')->unsigned()->nullable();

            $table->bigInteger('division_id')->unsigned()->nullable();
            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->bigInteger('upazila_id')->unsigned()->nullable();

            $table->bigInteger('market_id')->unsigned()->nullable();
            //bazar_id



            $table->bigInteger('approvedby_id')->unsigned()->nullable();

            $table->string('order_status')->default('pending');

            //pending
            //confirmed
            //processing
            //ready_to_ship
            //shipped
            //collected
            //delivered
            //cancelled
            //returned
            //undelivered

            // $table->bigInteger('sku_id')->unsigned()->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('sale_type')->nullable();
            //b_to_b //b_to_c

            $table->text('extra_description')->nullable();
            //if order cancel or return, details will be here with cause.

            $table->decimal('total_quantity',10,2)->default(0);
            $table->decimal('shipment_quantity',10,2)->default(0);
            $table->decimal('returned_quantity',10,2)->default(0);

            $table->decimal('unit_price',13,2)->default(0); //per unit
            $table->decimal('total_price',13,2)->default(0); //p * q
            
            $table->decimal('shipment_amount',13,2)->default(0); //p * q

            $table->decimal('unit_discount', 10,2)->default(0);
            //by deal,coupon,promotion,campaign and other discounts

            $table->decimal('total_discount', 10,2)->default(0);
            //ud * q


            $table->decimal('total_price_after_discount', 10,2)->default(0);
            //tpad = tp - td

            $table->decimal('affiliate_price',10,2)->default(0);
            //in tk (from aff.comm. percent in products_table)

            $table->decimal('final_price',10,2)->default(0);
            //fp= tpad - aff.comm
            //

            $table->decimal('total_weight',10,2)->default(0);

            // $table->decimal('paid_to_seller_amount',10,2)->default(0);
            //paid amount after calculating the charge 10% or whatever

            // $table->bigInteger('paid_to_seller_id')->unsigned()->nullable();
            //

            $table->bigInteger('addedby_id')->unsigned()->nullable();
            $table->bigInteger('editedby_id')->unsigned()->nullable();
            $table->boolean('stock_minimized')->default(0);

            $table->timestamp('pending_at')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('processing_at')->nullable();
            $table->timestamp('ready_to_ship_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->timestamp('undelivered_at')->nullable();

            $table->timestamp('paid_to_seller_at')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('shipment_items');
    }
}
