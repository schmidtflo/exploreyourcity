<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cities')->delete();
        
        \DB::table('cities')->insert(array (
            0 => 
            array (
                'id' => '1',
                'name' => 'Berlin',
                'latitude' => '52.518611',
                'longitude' => '13.408333',
                'created_at' => '2019-06-18 12:23:35',
                'updated_at' => '2019-06-18 12:23:35',
            ),
        ));
        
        
    }
}