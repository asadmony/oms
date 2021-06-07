<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_balances', function (Blueprint $table) {
            $table->id();

            // $table->decimal('total_pp', 13,2)->default(0);
            // $table->decimal('total_pp_value', 15,2)->default(0);


            // $table->decimal('lead_source_comm', 10,2)->default(0);
            //if source is absent            

            // $table->decimal('order_source_comm', 10,2)->default(0);
            //if source is absent

            $table->decimal('system_balance', 15,2)->default(0);
            //system total balance
            //base amount: 3,00,00,000

            $table->decimal('system_balance_comm', 10,2)->default(0);
            //this comm is for bj system balance portion's comm

            // $table->decimal('system_balance_undist_comm',10,2)->default(0); //10tk
            //delivered comm will be stored here for 1 day or 1 week or 1 month. then scheduled distribute to individual account

            $table->decimal('depo_balance', 12,4)->default(0);//total
            $table->decimal('distributor_balance', 12,4)->default(0);
            $table->decimal('dealer_balance', 12,4)->default(0);
            // $table->decimal('dealer_order_approved_balance', 12,4)->default(0);
            //total_order_confirmed_price
            
            $table->decimal('agent_balance', 12,4)->default(0);

            //total system balance = system_balance + depot_balance + dist_balance + dealer_balance + dealer_order_approved_balance + agent_balance


            //system comm 40 tk
            // $table->decimal('system_marketing_comm', 10,2)->default(0);
            // 4 tk
            // $table->decimal('system_management_comm', 10,2)->default(0);
            // 3 tk
            // $table->decimal('system_dev_comm', 10,2)->default(0);
            // 3 tk
            // $table->decimal('system_property_comm', 10,2)->default(0);
            //4 tk
            // $table->decimal('system_seminer_comm', 10,2)->default(0);
            //3 tk
            // $table->decimal('system_fund_comm', 10,2)->default(0);
            //3 tk
            // $table->decimal('system_social_fund_comm', 10,2)->default(0);
            //4 tk
            // $table->decimal('system_owner_comm', 10,2)->default(0);
            //5 tk
            // $table->decimal('system_role_comm', 10,2)->default(0);
            //4 tk
            // $table->decimal('system_r_n_d_comm', 10,2)->default(0);
            //4 tk
            // $table->decimal('system_law_and_lawer_comm', 10,2)->default(0);
            //3 tk

            $table->bigInteger('editedby_id')
                  ->unsigned()
                  ->nullable();

            $table->timestamps();

            // $table->timestamp('s_b_c_distributed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_balances');
    }
}
