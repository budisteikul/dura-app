<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevShoppingcartQuestionOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rev_shoppingcart_question_options', function (Blueprint $table) {
            $table->uuid('id')->primary();
			
			$table->uuid('shoppingcart_question_id');
			$table->foreign('shoppingcart_question_id')
      				->references('id')->on('rev_shoppingcart_questions')
      				->onDelete('cascade')->onUpdate('cascade');
			
			$table->string('label')->nullable();
			$table->string('value')->nullable();
			$table->string('order')->nullable();
			$table->tinyInteger('answer')->default(0);
					
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
        Schema::dropIfExists('rev_shoppingcart_question_options');
    }
}
