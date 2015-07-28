<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username')->unique('username', 'users_username_unique');
			$table->string('password');
			$table->string('firstname');
			$table->string('lastname');
			$table->datetime('birthdate');
			$table->string('email')->unique('email', 'users_email_unique');
			$table->string('remember_token')->default('');
			$table->integer('activate')->default(1);
/*			$table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->nullable();*/
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
		Schema::drop('users');
	}

}
