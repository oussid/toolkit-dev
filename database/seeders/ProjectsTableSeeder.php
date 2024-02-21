<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('projects')->delete();
        
        \DB::table('projects')->insert(array (
            0 => 
            array (
                'id' => 1,
                'business_id' => 1,
                'start_date' => '2023-07-18',
                'finish_date' => NULL,
                'status' => 'ongoing',
                'notes' => 'lhuihb lb:',
                'objectives' => '["jnnjmhgm"]',
                'created_at' => '2023-07-17 12:13:13',
                'updated_at' => '2023-07-17 12:13:13',
            ),
            1 => 
            array (
                'id' => 2,
                'business_id' => 1,
                'start_date' => '2023-07-26',
                'finish_date' => NULL,
                'status' => 'pending',
                'notes' => ',,,',
                'objectives' => '["sldkfj sldmf sdf"]',                
                'created_at' => '2023-07-17 12:13:43',
                'updated_at' => '2023-07-17 12:13:43',
            ),
            2 => 
            array (
                'id' => 3,
                'business_id' => 1,
                'start_date' => '2023-07-21',
                'finish_date' => NULL,
                'status' => 'canceled',
                'notes' => ';;;',
                'objectives' => '["455"]',
                'created_at' => '2023-07-17 14:37:00',
                'updated_at' => '2023-07-17 14:37:00',
            ),
        ));
        
        
    }
}