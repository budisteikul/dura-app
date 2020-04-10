<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevShoppingcarts extends Migration
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
			
			$table->string('bookingStatus')->default('CART');
			$table->string('sessionBooking')->nullable();
			$table->string('sessionId')->nullable();
			$table->string('confirmationCode')->nullable();
			
			$table->string('orderID')->nullable();
			$table->string('authorizationID')->nullable();
			
			$table->float('subtotal')->default(0);
			$table->float('discount')->default(0);
			$table->float('tax')->default(0);
			$table->float('fee')->default(0);
			$table->float('total')->default(0);
			
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
