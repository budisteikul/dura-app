<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rev_reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->uuid('post_id');
			$table->foreign('post_id')
      			->references('id')->on('blog_posts')
      			->onDelete('cascade')->onUpdate('cascade');
			
			$table->string('user')->nullable();
			$table->string('title')->nullable();
			$table->text('text')->nullable();
			$table->float('rating')->nullable();
			$table->dateTime('date')->nullable();
			$table->string('source')->nullable();
				
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
		Schema::table('rev_reviews', function (Blueprint $table) {
             $table->dropForeign('rev_reviews_post_id_foreign');
        });
        Schema::dropIfExists('rev_reviews');
    }
}
