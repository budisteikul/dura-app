<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevCartsDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rev_carts_detail', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->uuid('cart_id');
			$table->foreign('cart_id')
      			->references('id')->on('rev_carts')
      			->onDelete('cascade')->onUpdate('cascade');
			
			$table->string('type')->default('product');
				
			$table->string('title')->nullable();
			$table->string('qty')->nullable();
			$table->string('price')->nullable();
			$table->string('unitPrice')->nullable();
			
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
        Schema::dropIfExists('rev_carts_detail');
    }
}
