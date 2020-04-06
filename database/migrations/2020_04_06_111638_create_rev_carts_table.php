<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rev_carts', function (Blueprint $table) {
            $table->uuid('id')->primary();
			
			$table->string('sessionId')->nullable();
			$table->string('sessionBooking')->nullable();
			$table->string('parrentId')->nullable();
			$table->string('parrentConfirmationCode')->nullable();
			$table->string('bookingId')->nullable();	
			$table->string('productConfirmationCode')->nullable();
			$table->string('bookingStatus')->default('CART');
			
			$table->string('image')->nullable();
			$table->string('title')->nullable();
			$table->string('rate')->nullable();
			$table->string('date')->nullable();
			
			$table->string('firstName')->nullable();
			$table->string('lastName')->nullable();
			$table->string('email')->nullable();
			$table->string('phoneNumber')->nullable();
			
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
        Schema::dropIfExists('rev_carts');
    }
}
