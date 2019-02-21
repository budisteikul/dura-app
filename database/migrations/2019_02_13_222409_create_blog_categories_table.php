<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
			
			$table->uuid('parent_id');
				
			$table->uuid('user_id');
			$table->foreign('user_id')
      			->references('id')->on('users')
      			->onDelete('cascade')->onUpdate('cascade');
			
			$table->string('name')->nullable();
			$table->string('slug')->nullable();
			$table->longText('description')->nullable();
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
		Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropForeign('blog_categories_user_id_foreign');
        });
        Schema::dropIfExists('blog_categories');
    }
}
