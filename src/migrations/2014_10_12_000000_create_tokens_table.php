<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tokens', function(Blueprint $table)
		{
      $table->string('key', 120);
      $table->primary('key');
      $table->string('email', 120);
      $table->string('type', 60)->nullable();
      $table->timestamp('expires_at')->nullable();
      $table->timestamp('verified_at')->nullable();
      $table->timestamp('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tokens');
	}

}
