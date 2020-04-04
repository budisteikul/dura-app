<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevShoppingcartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rev_shoppingcarts', function (Blueprint $table) {
            $table->uuid('id')->primary();
			
			$table->string('sessionId')->nullable();
			$table->string('bookingId')->nullable();
			$table->string('sessionBooking')->nullable();
			$table->string('productConfirmationCode')->nullable();
			$table->string('bookingStatus')->nullable();
			
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rev_shoppingcarts');
    }
}
