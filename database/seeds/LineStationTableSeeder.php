<?php

use Illuminate\Database\Seeder;

class LineStationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('line_station')->delete();
        
        \DB::table('line_station')->insert(array (
            0 => 
            array (
                'line_id' => '1',
                'station_id' => '1',
            ),
            1 => 
            array (
                'line_id' => '1',
                'station_id' => '2',
            ),
        ));
        
        
    }
}