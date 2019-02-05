<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->uuid('user_id');
			$table->foreign('user_id')
      			->references('id')->on('users')
      			->onDelete('cascade')->onUpdate('cascade');
			$table->string('name',50)->nullable();
			$table->longText('value')->nullable();
            $table->timestamps();
        });
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('blog_settings', function (Blueprint $table) {
            $table->dropForeign('blog_settings_user_id_foreign');
        });
        Schema::dropIfExists('blog_settings');
		
    }
}
