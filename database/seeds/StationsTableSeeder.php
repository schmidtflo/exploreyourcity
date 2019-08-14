<?php

use Illuminate\Database\Seeder;

class StationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('stations')->delete();
        
        \DB::table('stations')->insert(array (
            0 => 
            array (
                'id' => '1',
                'city_id' => '1',
                'name' => 'Bismarckstraße',
                'latitude' => '52.511543',
                'longitude' => '13.305335',
                'created_at' => '2019-07-30 12:50:54',
                'updated_at' => '2019-07-30 12:50:54',
            ),
            1 => 
            array (
                'id' => '2',
                'city_id' => '1',
                'name' => 'Richard-Wagner-Straße',
                'latitude' => '52.517154',
                'longitude' => '13.307221',
                'created_at' => '2019-07-30 12:58:39',
                'updated_at' => '2019-07-30 12:58:39',
            ),
        ));
        
        
    }
}