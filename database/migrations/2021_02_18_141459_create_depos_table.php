<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')
                  ->unsigned()->nullable();
            $table->json('name')->nullable();
            $table->json('address')->nullable();
            $table->string('contact_numbers')->nullable();

            $table->string('nid')->nullable();

            $table->decimal('balance',12,4)->default(0);

            // $table->decimal('lead_depot_comm',12,4)->default(0);
            //will transfer to balance when amount 100
            // $table->decimal('order_depot_comm',12,4)->default(0);
            //will transfer to balance when amount 100

            // $table->decimal('system_balance_comm',12,4)->default(0);
            //will transfer to balance when amount 100

            // $table->decimal('system_owner_comm',12,4)->default(0);
            //will transfer to balance when amount 100

            $table->bigInteger('division_id')
                  ->unsigned()
                  ->nullable();
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('depos');
    }
}
