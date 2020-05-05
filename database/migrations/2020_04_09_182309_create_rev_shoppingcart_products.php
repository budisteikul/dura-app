<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevShoppingcartProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rev_shoppingcart_products', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->uuid('shoppingcarts_id');
			$table->foreign('shoppingcarts_id')
      				->references('id')->on('rev_shoppingcarts')
      				->onDelete('cascade')->onUpdate('cascade');
				
			$table->string('bookingId')->nullable();	
			$table->string('productConfirmationCode')->nullable();
			
			$table->string('productId')->nullable();
			$table->string('image')->nullable();
			$table->string('title')->nullable();
			$table->string('rate')->nullable();
			$table->dateTime('date')->nullable();
			
			$table->string('currency')->default('USD');
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
        Schema::dropIfExists('rev_shoppingcart_products');
    }
}
