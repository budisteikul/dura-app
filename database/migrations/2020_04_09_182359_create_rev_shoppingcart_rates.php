<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevShoppingcartRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rev_shoppingcart_rates', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->uuid('shoppingcart_products_id');
			$table->foreign('shoppingcart_products_id')
      			->references('id')->on('rev_shoppingcart_products')
      			->onDelete('cascade')->onUpdate('cascade');
			
			$table->string('type')->default('product');
				
			$table->string('title')->nullable();
			$table->string('qty')->nullable();
			$table->string('price')->nullable();
			$table->string('unitPrice')->nullable();
			
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
        Schema::dropIfExists('rev_shoppingcart_rates');
    }
}
