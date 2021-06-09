<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSrSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sr_salaries', function (Blueprint $table) {
            $table->id();
            $table->decimal('agent_id', 15, 2)->default(0);
            $table->decimal('previous_income', 15, 2)->default(0); 
            $table->decimal('paid_amount', 15, 2)->default(0);
            $table->decimal('current_income', 15, 2)->default(0); // previous_income - paid_amount
            $table->bigInteger('addedby_id')->nullable()->unsigned();
            $table->bigInteger('editedby_id')->nullable()->unsigned();
            $table->date('trans_date')->nullable();
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
        Schema::dropIfExists('sr_salaries');
    }
}
