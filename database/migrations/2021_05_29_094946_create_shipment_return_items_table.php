<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentReturnItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_return_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('shipment_return_id')->unsigned()->nullable();

            $table->bigInteger('shipment_id')->unsigned()->nullable();
            $table->bigInteger('shipment_item_id')->unsigned()->nullable();

            $table->bigInteger('order_id')->unsigned()->nullable();
            //ecommerce_order_id
            $table->bigInteger('order_item_id')->unsigned()->nullable();

            $table->bigInteger('product_id')->unsigned()->nullable();
            //ecommerce_product_id
            //
            $table->text('product_name')->nullable();

            $table->boolean('confirmed')->default(false);
            $table->boolean('completed')->default(false);

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

            $table->string('return_type')->nullable(); // product,payment
            
            $table->text('return_reason')->nullable();
            //cause of return
            
            $table->string('image_1')->nullable(); 
            $table->string('image_2')->nullable(); 

            $table->decimal('order_quantity',10,2)->default(0);
            $table->decimal('shipment_quantity',10,2)->default(0);
            $table->decimal('return_quantity',10,2)->default(0);

            $table->decimal('unit_price',13,2)->default(0); //per unit

            $table->decimal('shipment_amount',15,2)->default(0); //p * q

            $table->decimal('return_amount',15,2)->default(0); //p * q


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

            $table->timestamp('return_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('received_at')->nullable();

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
        Schema::dropIfExists('shipment_return_items');
    }
}
