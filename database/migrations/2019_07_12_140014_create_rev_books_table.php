<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rev_books', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->uuid('post_id');
			$table->foreign('post_id')
      			->references('id')->on('blog_posts')
      			->onDelete('cascade')->onUpdate('cascade');
				
			$table->string('name')->nullable();
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
			$table->integer('traveller')->default(1);
			$table->dateTime('date')->nullable();
			$table->string('source')->nullable();
			$table->string('ticket')->nullable();
			$table->tinyInteger('status')->default(1);
			
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
		Schema::table('rev_books', function (Blueprint $table) {
             $table->dropForeign('rev_books_post_id_foreign');
        });
        Schema::dropIfExists('rev_books');
    }
}
