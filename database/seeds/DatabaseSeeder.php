<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(UsersTableSeeder::class);
		$this->call(CitiesTableSeeder::class);
		$this->call(StationsTableSeeder::class);
		$this->call(LineTypesTableSeeder::class);
		$this->call(LinesTableSeeder::class);
		$this->call(LineStationTableSeeder::class);
	}
}
