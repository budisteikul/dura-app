<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevResellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rev_resellers', function (Blueprint $table) {
            $table->string('id')->primary();
			
			$table->string('name')->nullable();
			$table->integer('status')->nullable();
			
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
        Schema::dropIfExists('rev_resellers');
    }
}
