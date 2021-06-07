<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcommerceSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerce_sources', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            //seller user //owner

            $table->bigInteger('addedby_id')->unsigned();
            $table->bigInteger('editedby_id')->unsigned()->nullable();


            $table->string('email', 32)
                  ->nullable();

            $table->string('mobile', 32)
                  ->nullable();

            $table->string('mobile_optional')
                  ->nullable();

            $table->json('name')->nullable();

            $table->string('owner_name')->nullable();
            //title in localeable table
            $table->json('slogan')->nullable();
            //slogan in localeble table

            
            $table->json('description')->nullable();
            // description in localeable table

            $table->json('address')->nullable();
            //address in localeable table

            $table->decimal('initial_amount',15,2)->default(0);
            
            $table->decimal('due_amount',15,2)->default(0);

            $table->decimal('monthly_target',15,2)->default(0);

            $table->decimal('total_sale',15,2)->default(0);
            $table->decimal('total_sale_commission',15,2)->default(0);
            $table->decimal('current_sale',15,2)->default(0);
            $table->decimal('current_sale_commission',15,2)->default(0);
            $table->decimal('total_collection',15,2)->default(0);
            $table->decimal('total_collection_commission',15,2)->default(0);
            $table->decimal('current_collection',15,2)->default(0);
            $table->decimal('current_commission',15,2)->default(0);

            // $table->string('color_main')->nullable();
            // $table->string('color_font')->nullable();
            // $table->string('color_name')->nullable();
            // $table->string('color_slogan')->nullable();

            

            $table->string('cover_img')->nullable();
            //image name

            $table->string('logo')->nullable();
            //logo image name

            $table->string('type')->nullable();
            //type: manufacturer/producer, importer/exporter, supplier/wholesale, shop, SME



            $table->string('mobile_country', 2)
                  ->nullable();
            //for outside bangladesh

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


            $table->boolean('active')->default(1);

            $table->decimal('balance',12,4)->default(0);
            

            $table->integer('seller_commission')->default(10);
            //in percent //default 10% of product price will be given by seller to cp
            //it will hit during order is delivered 



            // $table->decimal('product_source_comm',12,4)->default(0);
            //will transfer to balance when amount 100
            // $table->decimal('order_source_comm',12,4)->default(0);
            //will transfer to balance when amount 100

            $table->boolean('pos')->default(0);
            //pos system for this source for local business


            $table->boolean('self_domain')->default(0);
            //myshop.com or any other domain attached 

            $table->boolean('sale_to_cp')->default(1);
            //available for sale to cp
            
            $table->boolean('sale_from_cp')->default(0);
            //other's shop's products also will be available in this shop

            $table->string('status')
                  ->default('normal'); //temp, premium,normal,suspended


            //https://schema.org/LocalBusiness
            //for seo

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
        Schema::dropIfExists('ecommerce_sources');
    }
}
