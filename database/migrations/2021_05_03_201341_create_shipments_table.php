<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->bigInteger('depo_id')->unsigned()->nullable();

            $table->bigInteger('distributor_id')->unsigned()->nullable();
            $table->bigInteger('dealer_id')->unsigned()->nullable();
            $table->bigInteger('agent_id')->unsigned()->nullable();

            $table->bigInteger('division_id')->unsigned()->nullable();
            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->bigInteger('upazila_id')->unsigned()->nullable();

            $table->bigInteger('market_id')->unsigned()->nullable();
            //bazar_id

            $table->bigInteger('source_id')->unsigned()->nullable();
            //optional (this time source is buyer shop or any)

            $table->bigInteger('approvedby_id')->unsigned()->nullable();

            $table->string('mobile')->nullable();
            $table->text('address')->nullable();

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

            //pending,
            //cencelled, by agent, dealer or dealer's worker
            //confirmed (by agent)
            //approved (by dealer or dealer's worker with calling to different sources for approved individual)
            //this time dealer or dealer's worker can skip individual source-item by cancel it or update quantity and add the approximate collecting date

            //processing, when all the source-item accepted then this status will be changed and  shown automatically.

            //ready to ship, when all the source-item's status change into  ready_to_ship then this status will be changed and shown automatically.

            //shipped, when all the source-item's status change into shipped then automatically this happened and shown.

            //collected,
            //delivered.

            $table->string('payment_status')->default('unpaid');
            //unpaid, partial, paid

            $table->decimal('total_quantity',10,2)->default(0);
            $table->decimal('total_price',10,2)->default(0);
            $table->decimal('shipment_price',10,2)->default(0);
            $table->decimal('total_weight',10,2)->default(0);
            $table->decimal('total_paid',10,2)->default(0);
            $table->decimal('total_due',10,2)->default(0);

            // $table->decimal('total_order_confirmed_price',10,2)->default(0);
            // //same value as total_price_with_pp

            //order payment history will be stored in order_payments table.
            //delivered status not be possible before full paid by customer.

            //approved status not be possible if dealer has no available balance equal to total_price_with_pp

            //when full paid or partial or unpaid but order approved, amount will remain in total_paid pocket.
            //but order_confirmed_price will be moved from dealer account to each single item.
            //this amount will show to lead publisher dealer and lead owner(only total_price)

            //when order delivered, order_item's order_confirmed_price will be distribute in owner's balance pocket (price) with history and pp to others commission pocket. total_paid balance will be moved to buyer dealer's balance pocket with history.

            //when full paid (cash to agent) by agent, agent's balance will minimize from zero to nagetive. when payment tk handover to dealer office, dealer will be transfer balance again and collect physical tk from agent.

            //if agent has nagetive balance, new payment for customer will not be possible by this agent.



            $table->bigInteger('addedby_id')->unsigned()->nullable();
            $table->bigInteger('editedby_id')->unsigned()->nullable();

            $table->timestamp('pending_at')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('processing_at')->nullable();
            $table->timestamp('ready_to_ship_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('collected_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->timestamp('undelivered_at')->nullable();
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
        Schema::dropIfExists('shipments');
    }
}
