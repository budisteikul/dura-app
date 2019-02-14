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
			
				
			$table->string('file_name')->nullable();
			$table->string('file_height')->nullable();
			$table->string('file_width')->nullable();
			$table->string('file_mimetype')->nullable();
			$table->string('file_size')->nullable();
			$table->string('file_path')->nullable();
			$table->string('file_url')->nullable();
			$table->integer('sort')->nullable();
			
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
		Schema::table('blog_attachments', function (Blueprint $table) {
             $table->dropForeign('blog_attachments_post_id_foreign');
        });
        Schema::dropIfExists('blog_attachments');
    }
}
