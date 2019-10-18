<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rev_widgets', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->uuid('post_id');
			$table->foreign('post_id')
      			->references('id')->on('blog_posts')
      			->onDelete('cascade')->onUpdate('cascade');
			
			$table->string('product')->nullable();
			$table->string('time_selector')->nullable();
			$table->string('checkout')->nullable();
			$table->string('receipt')->nullable();
			
				
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
		Schema::table('rev_widgets', function (Blueprint $table) {
             $table->dropForeign('rev_widgets_post_id_foreign');
        });
        Schema::dropIfExists('rev_widgets');
    }
}
