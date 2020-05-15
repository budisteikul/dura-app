<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevExperiences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rev_experiences', function (Blueprint $table) {
            $table->uuid('id')->primary();
			
			$table->string('productId')->nullable();
			$table->string('title')->nullable();
			$table->string('slug')->nullable();
			
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
        Schema::dropIfExists('rev_experiences');
    }
}
