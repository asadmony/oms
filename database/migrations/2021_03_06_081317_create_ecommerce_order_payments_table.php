<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcommerceOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerce_order_payments', function (Blueprint $table) {
            $table->id();
            $table->date('trans_date')
                  ->nullable();
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable(); 
            //order's owner user_id
             
            $table->string('payment_by')->nullable();
            //balance, agent, dealer, bkash, nagad, stripe, card, sslcommerze 

            $table->string('payment_type')->nullable();
            //cash, bank, mobile bank, cheque, online

            $table->string('payment_status')->default('pending');
            //pending, on_review, completed

            $table->string('bank_name')->nullable();
            //bkash

            $table->string('account_number')->nullable();
            //01918515567

            $table->string('cheque_number')->nullable();
            //2315465231654

            $table->text('note')->nullable();

            $table->decimal('paid_amount', 13, 2)
                  ->nullable();

            $table->bigInteger('receivedby_id')
                  ->unsigned()->nullable();


            $table->bigInteger('addedby_id')
                  ->unsigned()
                  ->nullable();

            $table->integer('editedby_id')
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
        Schema::dropIfExists('ecommerce_order_payments');
    }
}
