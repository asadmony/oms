<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_accounts', function (Blueprint $table) {
            //member_accounts for 
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            // $table->bigInteger('role_id')->unsigned()->nullable();
            //if role_id deleted, member_account will not be deleted.
            //rather, previous rold_id (member role_id) will be replaced by new role_id with the help of user_id.

            // $table->decimal('purchase_amount', 12, 4)->default(0);
            //e.g: 5000/- 
            
            // $table->decimal('purchase_withdrawable_comm', 12, 4)->default(0); //in tk (maybe 10% of purchase_pp) for member

            // $table->decimal('sold_amount', 12,4)->default(0);
            //e.g: 10000/-
            
            // $table->decimal('sold_withdrawable_comm', 12, 4)->default(0); //in tk 

            // $table->decimal('pair_left_amount', 12, 4)->default(0);
            //peramid made from agent_id
            // $table->decimal('pair_right_amount', 12, 4)->default(0);
            //peramid made from agent_id

            // $table->decimal('pair_withdrawable_comm', 12, 4)->default(0); //some logic will be apply before hit this column


            $table->decimal('referral_withdrawable_comm', 12,4)->default(0);
            //in tk (some one-time commission will be here by referrer when first time purchase or sold occurs) 

            $table->decimal('balance', 12,2)->default(0);
            //in tk, this is cashout wallet. at first, transfer from any withdrawable_tk by user will be stored here. Then, this money can be cashout from office of epl. During transfer, transaction history will be stored with that withdrawable_tk mentioned by commission type. 

            // $table->decimal('lead_owner_comm',12,4)->default(0);
            //will transfer to balance when amount 100
   
            // $table->decimal('order_owner_comm', 12,4)->default(0);
            //will transfer to balance when amount 100
  

            // $table->string('purchase_member_type')->default('general');
            //general less < 1000pp purchase
            //silver 1000pp - 10000pp purchase
            //gold 10000pp - 100000pp Purchase
            //platinum 100000pp grater purchas

            // $table->string('sold_member_type')->default('general');
            //general less < 1000pp sold
            //silver 1000pp - 10000pp sold
            //gold 10000pp - 100000pp sold
            //platinum 100000pp grater sold by bangla junction
            //(manufacturer or importer or wholesaler through BJ)

            $table->bigInteger('refer_id')->unsigned()->nullable(); //user_id (who build or refer me to join bj)

            $table->boolean('verified_by_agent')->default(0);

            $table->bigInteger('agent_id')->unsigned()->nullable();//agent_id

            //name, gender, dob in user table

            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('national_id')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('nominee_name')->nullable();
            $table->date('nominee_dob')->nullable();
            $table->string('relation_with_nominee')->nullable();

            // $table->integer('pin')->nullable();

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
        Schema::dropIfExists('member_accounts');
    }
}
