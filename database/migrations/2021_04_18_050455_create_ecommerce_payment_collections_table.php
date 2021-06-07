<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcommercePaymentCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerce_payment_collections', function (Blueprint $table) {
            $table->id();
            $table->date('trans_date')
                  ->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            //payment collected from

            $table->bigInteger('agent_id')->unsigned()->nullable();
            $table->bigInteger('source_id')->unsigned()->nullable();
            //payment collected from

            $table->string('collected_by')->nullable();
            //balance, agent, dealer, bkash, nagad, stripe, card, sslcommerze

            $table->string('collection_type')->nullable();
            //cash, bank, mobile_bank, cheque, online

            $table->string('status')->default('pending');
            //pending, varified

            $table->string('bank_name')->nullable();
            //bkash

            $table->string('account_number')->nullable();
            //01918515567

            $table->string('cheque_number')->nullable();
            //2315465231654

            $table->string('image')->nullable();
            //

            $table->text('note')->nullable();

            $table->decimal('paid_amount', 15, 2)->default(0);

            $table->decimal('sr_commission_amount', 15, 2)
                  ->default(0);

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
        Schema::dropIfExists('ecommerce_payment_collections');
    }
}
