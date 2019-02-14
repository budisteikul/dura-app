<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->uuid('user_id');
			$table->foreign('user_id')
      			->references('id')->on('users')
      			->onDelete('cascade')->onUpdate('cascade');
				
			$table->string('title')->nullable();
			$table->string('slug')->nullable();
			$table->string('post_type',10)->default('post');
			$table->string('content_type',10)->default('text');
			$table->dateTime('date')->nullable();
			$table->longText('content')->nullable();
			$table->string('layout')->nullable();
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
		Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropForeign('blog_posts_user_id_foreign');
        });
        Schema::dropIfExists('blog_posts');
    }
}
