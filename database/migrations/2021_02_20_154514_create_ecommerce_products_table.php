<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcommerceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerce_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable(); 
            //product owner
            
            $table->bigInteger('source_id')->unsigned()->nullable();
            //source_id, source type in sources: wholesaleshop, retails shop, manufacturer, factory, supplier, importer 

            $table->bigInteger('category_id')->unsigned()->nullable();

            $table->json('name')->nullable();
            //json for multilanguage 

            $table->json('excerpt')->nullable();
            //only text-description few lines
            
            
            $table->json('description')->nullable();
            //details with specification

            $table->json('what_in_box')->nullable();

            $table->date('expire_date')->nullable();

            $table->string('product_condition')->nullable();
            //used, brand new, new, 2nd hand, reconditioned, custom
            
            $table->boolean('septic')->default(0);
            //পচনশীল 
            $table->boolean('liquid')->default(0);

            $table->boolean('inflammable')->default(0);
            //দাহ্য পদার্থ
            
            $table->boolean('pre_order')->default(0);
            //pre_booking
            
            $table->boolean('digital')->default(0);
            //downloadable product
            
            $table->boolean('refundable')->default(1);
            
            $table->string('warrenty_type')->default(1);
            //replacement_warrenty //no_warrenty //1 month_warrenty
            
            $table->string('warrenty_period')->nullable();
            //if w_type is no_warrenty selected, w_period will be hidden using jquery
            
            $table->string('ready_type')->nullable();
            //ready_to_ship //paid_sample //free_sample

            $table->boolean('b_to_b')->default(1);
            $table->boolean('b_to_c')->default(1);

            $table->string('mobile')->nullable(); 
            //mobile number will come from user and used by agent or dealer or admin

            $table->string('status')->nullable();
            //temp, pending (created by agent and pending for dealer), verified by agent, modified by agent, modified by dealer, published, cancelled by dealer


            $table->bigInteger('brand_id')->unsigned()->nullable();

            // $table->bigInteger('source_cat_id')
            // ->unsigned()
            // ->nullable();

            // $table->bigInteger('source_subcat_id')
            // ->unsigned()
            // ->nullable();

            // $table->bigInteger('general_cat_id')
            // ->unsigned()
            // ->nullable();

            // $table->bigInteger('general_subcat_id')
            // ->unsigned()
            // ->nullable();

            // $table->bigInteger('sale_cat_id')
            // ->unsigned()
            // ->nullable();

            // $table->bigInteger('sale_subcat_id')
            // ->unsigned()
            // ->nullable();

            $table->bigInteger('depo_id')->unsigned()->nullable();
            $table->bigInteger('distributor_id')->unsigned()->nullable();
            $table->bigInteger('dealer_id')->unsigned()->nullable();
            $table->bigInteger('agent_id')->unsigned()->nullable();

            $table->bigInteger('division_id')->unsigned()->nullable();
            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->bigInteger('upazila_id')->unsigned()->nullable();
            $table->bigInteger('market_id')->unsigned()->nullable();
            //bazar_id 

            $table->string('lat')->nullable();
            $table->string('lng')->nullable();

            $table->date('publish_date')->nullable();

            $table->date('close_date')->nullable();
            //lead expired and hide from cp, can be increased

            $table->date('mfg_date')->nullable();
            //mfg_date or packed date

            $table->date('exp_date')->nullable();
            //expired date is date for product expired

            $table->string('feature_img')->nullable();
            //also feature image will be in media-gallery

            // $table->string('name')->nullable()->index();
            // //title

            // $table->string('name_bn')->nullable()->index();

            // $table->longText('description')->nullable();

            // $table->longText('description_bn')->nullable();
            
            //name description in localeable table


            $table->integer('quantity')->nullable();
            //if null, in stock;

            $table->integer('min_order_quantity')->nullable();
            $table->integer('max_order_quantity')->nullable();



            // $table->decimal('purchase_price', 11, 2)->default(0);
            //purchase price
            
            $table->decimal('purchase_price', 11, 2)->nullable();
            $table->decimal('sale_price', 11, 2)->nullable();

            $table->decimal('compare_price', 11, 2)->nullable();
            //campare price is deleted price or previous price
            //it will not work when new offer price is set in any coupon or campaign


            $table->integer('affiliate_commission')->default(0);
            //in percent 

            // $table->decimal('sale_price', 11, 2)->default(0);
            // //regular sale price
            
            // $table->decimal('discount', 10, 2)->default(0);
            // $table->string('discount_type')->default('percent');
            // //percent, flat

            // $table->decimal('discount_amount',10,2)->default(0);
            // //calculated by percent or flat
            
            // $table->decimal('final_price', 11, 2)->default(0);
            // //fp = sp - da
            
            // $table->date('discount_start_date')->nullable();
            // $table->date('discount_end_date')->nullable();

            // //offer_price will be calculate in model

            $table->decimal('unit_weight', 9,2)->nullable();
             //20.5  in 

            $table->string('unit')->nullable();
            //kg, meter, liter, 

            $table->bigInteger('addedby_id')->unsigned();
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
        Schema::dropIfExists('ecommerce_products');
    }
}