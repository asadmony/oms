<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('roleto_id')->unsigned()->nullable(); 
            $table->string('roleto_type')->nullable();
            //depo, dealer, distributor, agent,OrderPayment

            $table->bigInteger('roleby_id')->unsigned()->nullable(); 
            $table->string('roleby_type')->nullable();
            //depo, dealer, distributor, agent,source,user,WebsiteBalance,

            $table->string('from')->nullable();
            //from: depo, dealer, distributor, agent, source, user, admin


            $table->string('payment_type')->nullable();
            //cash, bank, mobile bank, check, online, dealer_balance,

            $table->string('payment_status')->default('pending');
            //pending, completed

            $table->string('bank_name')->nullable();
            //bkash

            $table->string('account_number')->nullable();
            //01918515567

            $table->string('cheque_number')->nullable();
            //2315465231654

            $table->text('note')->nullable();

            $table->decimal('previous_balance',12,4)->default(0);
            $table->decimal('transfer_amount', 12,2)->default(0);
            $table->decimal('current_balance', 12,4)->default(0);

            $table->bigInteger('addedby_id')
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
        Schema::dropIfExists('role_payments');
    }
}
