<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_attachments', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->uuid('post_id');
			$table->foreign('post_id')
      			->references('id')->on('blog_posts')
      			->onDelete('cascade')->onUpdate('cascade');
			$table->uuid('user_id');
			$table->foreign('user_id')
      			->references('id')->on('users')
      			->onDelete('cascade')->onUpdate('cascade');
			$table->string('public_id',255)->nullable();
			$table->string('version',255)->nullable();
			$table->string('signature',255)->nullable();
			$table->string('width',255)->nullable();
			$table->string('height',255)->nullable();
			$table->string('format',255)->nullable();
			$table->string('resource_type',255)->nullable();
			$table->string('bytes',255)->nullable();
			$table->string('type',255)->nullable();
			$table->string('etag',255)->nullable();
			$table->string('url',255)->nullable();
			$table->string('secure_url',255)->nullable();
			$table->integer('sort')->nullable();
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
		Schema::table('blog_attachments', function (Blueprint $table) {
             $table->dropForeign('blog_attachments_post_id_foreign');
        });
		Schema::table('blog_attachments', function (Blueprint $table) {
            $table->dropForeign('blog_attachments_user_id_foreign');
        });
        Schema::dropIfExists('blog_attachments');
    }
}
