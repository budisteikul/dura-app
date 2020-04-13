<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevShoppingcartQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rev_shoppingcart_questions', function (Blueprint $table) {
            $table->uuid('id')->primary();
			
			$table->uuid('shoppingcarts_id');
			$table->foreign('shoppingcarts_id')
      				->references('id')->on('rev_shoppingcarts')
      				->onDelete('cascade')->onUpdate('cascade');
					
			$table->string('type')->nullable();
			$table->string('bookingId')->nullable();
			$table->string('questionId')->nullable();
			$table->string('label')->nullable();
			$table->string('dataType')->nullable();
			$table->string('dataFormat')->nullable();
			$table->string('required')->nullable();
			$table->string('selectOption')->nullable();
			$table->string('selectMultiple')->nullable();
			$table->string('help')->nullable();
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
        Schema::dropIfExists('rev_shoppingcart_questions');
    }
}
