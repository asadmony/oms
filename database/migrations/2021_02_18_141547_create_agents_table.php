<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')
                  ->unsigned()->nullable();
            $table->integer('depo_id')->nullable();
            $table->integer('distributor_id')->nullable();
            $table->integer('dealer_id')->nullable();
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

            $table->decimal('balance',15,2)->default(0);
            
            $table->decimal('monthly_target',12,2)->default(0);

            $table->decimal('total_sale',15,2)->default(0);
            $table->decimal('total_sale_commission',15,2)->default(0);
            $table->decimal('current_sale',15,2)->default(0);
            $table->decimal('current_sale_commission',15,2)->default(0);
            $table->decimal('total_collection',15,2)->default(0);
            $table->decimal('total_collection_commission',15,2)->default(0);
            $table->decimal('current_collection',15,2)->default(0);
            $table->decimal('current_commission',15,2)->default(0);

            // $table->decimal('lead_agent_comm',12,4)->default(0);
            //will transfer to balance when amount 100
            // $table->decimal('order_agent_comm',12,4)->default(0);
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
        Schema::dropIfExists('agents');
    }
}
