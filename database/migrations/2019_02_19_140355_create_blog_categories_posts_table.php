<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogCategoriesPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories_posts', function (Blueprint $table) {
			
			$table->uuid('user_id');
			$table->foreign('user_id')
      			->references('id')->on('users')
      			->onDelete('cascade')->onUpdate('cascade');
			
			$table->uuid('category_id');
			$table->foreign('category_id')
      			->references('id')->on('blog_categories')
      			->onDelete('cascade')->onUpdate('cascade');
				
			$table->uuid('post_id');
			$table->foreign('post_id')
      			->references('id')->on('blog_posts')
      			->onDelete('cascade')->onUpdate('cascade');
				
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
		Schema::table('blog_categories_posts', function (Blueprint $table) {
            $table->dropForeign('blog_categories_posts_category_id_foreign');
			$table->dropForeign('blog_categories_posts_post_id_foreign');
			$table->dropForeign('blog_categories_posts_user_id_foreign');
        });
        Schema::dropIfExists('blog_categories_posts');
    }
}
