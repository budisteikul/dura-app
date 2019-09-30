<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->uuid('id')->primary();
			
			$table->string('msisdn')->nullable();
			$table->string('to')->nullable();
			$table->string('messageId')->nullable();
			$table->string('text')->nullable();
			$table->string('type')->nullable();
			$table->string('keyword')->nullable();
			$table->string('message_timestamp')->nullable();
			
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
        Schema::dropIfExists('sms');
    }
}
