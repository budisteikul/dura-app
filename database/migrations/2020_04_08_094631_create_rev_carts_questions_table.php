<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevCartsQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rev_carts_question', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->uuid('cart_id');
			$table->foreign('cart_id')
      			->references('id')->on('rev_carts')
      			->onDelete('cascade')->onUpdate('cascade');
				
			$table->string('type')->default('main');
			
			$table->string('bookingId')->nullable();
			$table->string('questionId')->nullable();
			$table->string('label')->nullable();
			$table->string('dataType')->nullable();
			$table->string('dataFormat')->nullable();
			$table->string('required')->nullable();
			$table->string('selectOption')->nullable();
			$table->string('selectMultiple')->nullable();
			$table->string('order')->nullable();
			$table->string('answer')->nullable();
				
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
        Schema::dropIfExists('rev_carts_question');
    }
}
