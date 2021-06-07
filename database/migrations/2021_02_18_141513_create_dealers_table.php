<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')
                  ->unsigned()->nullable();
            $table->integer('depo_id')->nullable();
            $table->integer('distributor_id')->nullable();
            $table->json('name')->nullable();
            $table->bigInteger('division_id')
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('district_id')
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('upazila_id')
                  ->unsigned()
                  ->nullable();
            $table->boolean('active')->default(1);
            
            $table->string('nid')->nullable();

            $table->decimal('balance',12,4)->default(0);

            // $table->decimal('total_order_confirmed_price',12,4)->default(0);
            //all confirmed price from all orders

            // $table->decimal('lead_dealer_comm',12,4)->default(0);
            //will transfer to balance when amount 100
            // $table->decimal('order_dealer_comm',12,4)->default(0);
            //will transfer to balance when amount 100

            // $table->decimal('system_balance_comm',12,4)->default(0);
            //will transfer to balance when amount 100

            // $table->decimal('system_owner_comm',12,4)->default(0);
            //will transfer to balance when amount 100



            $table->json('address')->nullable();
            $table->string('contact_numbers')->nullable();
            $table->bigInteger('addedby_id')
                  ->unsigned();
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
        Schema::dropIfExists('dealers');
    }
}
