<?php

use Illuminate\Database\Seeder;

class LineTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('line_types')->delete();
        
        \DB::table('line_types')->insert(array (
            0 => 
            array (
                'id' => '1',
                'city_id' => '1',
                'name' => 'S-Bahn',
                'abbreviation' => 'S',
                'color' => '#3c773f',
                'created_at' => '2019-07-30 12:42:03',
                'updated_at' => '2019-07-30 12:42:03',
            ),
            1 => 
            array (
                'id' => '2',
                'city_id' => '1',
                'name' => 'U-Bahn',
                'abbreviation' => 'U',
                'color' => '#003399',
                'created_at' => '2019-07-30 12:45:51',
                'updated_at' => '2019-07-30 12:45:51',
            ),
        ));
        
        
    }
}