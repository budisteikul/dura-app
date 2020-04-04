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
            $table->string('id')->primary();
			$table->string('sessionId')->nullable();
			$table->string('sessionBooking')->nullable();
			$table->string('parrentId')->nullable();
			$table->string('parrentConfirmationCode')->nullable();
			$table->string('bookingId')->nullable();
			$table->string('productConfirmationCode')->nullable();
			$table->string('bookingStatus')->nullable();
			$table->string('title')->nullable();
			$table->string('rateTitle')->nullable();
			
			$table->string('firstName')->nullable();
			$table->string('lastName')->nullable();
			$table->string('email')->nullable();
			$table->string('phoneNumber')->nullable();
			
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
