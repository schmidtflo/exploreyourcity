<?php

use Illuminate\Database\Seeder;

class LinesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lines')->delete();
        
        \DB::table('lines')->insert(array (
            0 => 
            array (
                'id' => '1',
                'city_id' => '1',
                'line_type_id' => '2',
                'name' => 'U7',
                'color' => '#33ccff',
                'created_at' => '2019-07-30 12:50:00',
                'updated_at' => '2019-07-30 12:50:00',
            ),
        ));
        
        
    }
}