<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{


		\DB::table('users')->delete();

		\DB::table('users')->insert(array(
			0 =>
				array(
					'id' => 'f292e1b0-c05e-11e9-9277-7f17d8064aa4',
					'name' => 'Admin',
					'email' => 'admin@exploreyour.city',
					'email_verified_at' => NULL,
					'password' => '$2y$10$0QzwWm8coQuBHGUTO0O4hOE2Fg7HxYK7gQwoEPmvvFhUEzQshInZi',
					'remember_token' => NULL,
					'is_admin' => true,
					'created_at' => '2019-06-16 21:56:51',
					'updated_at' => '2019-06-16 21:56:51',
				),
		));


	}
}
