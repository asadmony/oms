<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_domains', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('domainable_id') //ecommerce_source_id
                  ->unsigned()
                  ->nullable();
            $table->string('domainable_type')->nullable();
            //App\Models\Ecommerce\EcommerceSource

            $table->string('domain'); //abc.com //kakkufashion.com
            $table->bigInteger('addedby_id') //own id or other id
                  ->unsigned()
                  ->nullable();
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
        Schema::dropIfExists('project_domains');
    }
}
