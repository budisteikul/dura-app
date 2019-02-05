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
			$table->string('judul',255)->nullable();
			$table->string('slug',255)->nullable();
			$table->string('tipe_post',10)->default('post');
			$table->string('tipe_konten',10)->default('text');
			$table->dateTime('tanggal')->nullable();
			$table->longText('konten')->nullable();
			$table->string('layout')->nullable();
			$table->longText('note')->nullable();
			$table->tinyInteger('status')->default(1);
            $table->nullableTimestamps();
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
