<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BusinessesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('businesses')->delete();
        
        \DB::table('businesses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'name' => 'Jennie Butler',
                'address' => 'JIeVSoP2S',
                'number' => 'ljkljdlkfjlkq najojlkj',
                'website' => 'lkjlkdfjlkjjoi²bkljd ljl',
                'niche' => 'jdf jmsdf dsf',
                'email' => 'contact@idsaid.com',
                'rating' => 4.5,
                'status' => 0,
                'contacted_at' => null,
                'contacted_by' => null,
                'created_at' => '2023-07-17 12:12:22',
                'updated_at' => '2023-07-17 15:51:09',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'name' => 'Jorge Gonzales',
                'address' => 'gtrwJi',
                'number' => 'lkjkldfjklja',
                'website' => 'ljlkjflkj',
                'niche' => 'sdklfjlk',
                'email' => NULL,
                'rating' => NULL,
                'status' => 0,
                'contacted_at' => null,
                'contacted_by' => null,
                'created_at' => '2023-07-17 12:12:22',
                'updated_at' => '2023-07-17 13:38:46',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'name' => 'Willie Payne',
                'address' => 'L9bcAanV0bbf63',
                'number' => 'kldfjl',
                'website' => 'j',
                'niche' => 'kjj',
                'email' => NULL,
                'rating' => NULL,
                'status' => 0,
                'contacted_at' => null,
                'contacted_by' => null,
                'created_at' => '2023-07-23 12:12:22',
                'updated_at' => '2023-07-24 10:58:42',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'name' => 'Russell Dean',
                'address' => 'U9FfNMf',
                'number' => 'lklskdfjlk',
                'website' => 'kjsdlkfjlk',
                'niche' => 'jksdjfl',
                'email' => NULL,
                'rating' => NULL,
                'status' => 0,
                'contacted_at' => null,
                'contacted_by' => null,
                'created_at' => '2023-07-23 12:12:22',
                'updated_at' => '2023-07-22 18:05:30',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'name' => 'Hallie Cross',
                'address' => 'UBOWYg',
                'number' => 'jjlkjljl',
                'website' => 'ljlkjlk',
                'niche' => 'jlkj',
                'email' => NULL,
                'rating' => NULL,
                'status' => 0,
                'contacted_at' => null,
                'contacted_by' => null,
                'created_at' => '2023-07-23 12:12:22',
                'updated_at' => '2023-07-22 18:05:29',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 1,
                'name' => 'Winifred Gross&y',
                'address' => 'RrtmByyxKjR1',
                'number' => 'hy',
                'website' => NULL,
                'niche' => 'jlkjjlkl',
                'email' => NULL,
                'rating' => NULL,
                'status' => 0,
                'contacted_at' => null,
                'contacted_by' => null,
                'created_at' => '2023-07-23 00:00:00',
                'updated_at' => '2023-07-22 18:05:28',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 1,
                'name' => 'Phillip Tucker&',
                'address' => 'b4aOP',
                'number' => 'yftf',
                'website' => NULL,
                'niche' => 'jlkjjlkl',
                'email' => NULL,
                'rating' => NULL,
                'status' => 0,
                'contacted_at' => null,
                'contacted_by' => null,
                'created_at' => '2023-07-24 10:48:21',
                'updated_at' => '2023-07-22 18:05:32',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 1,
                'name' => 'Gertrude Cook',
                'address' => 'KtvNP3PJqviSCZllt',
                'number' => '32131651',
                'website' => NULL,
                'niche' => '',
                'email' => NULL,
                'rating' => NULL,
                'status' => 0,
                'contacted_at' => null,
                'contacted_by' => null,
                'created_at' => '2023-07-24 00:00:00',
                'updated_at' => '2023-07-24 10:58:44',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 1,
                'name' => 'Verna Fernandez',
                'address' => 'qDKLMEztKNeMLSfEG',
                'number' => 'lkjdsoifhn',
                'website' => 'pjskdfjlkj',
                'niche' => 'lkjlkj',
                'email' => NULL,
                'rating' => NULL,
                'status' => 0,
                'contacted_at' => null,
                'contacted_by' => null,
                'created_at' => '2023-07-24 10:59:43',
                'updated_at' => '2023-07-24 11:00:46',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 1,
                'name' => 'Etta Bishop',
                'address' => 'TAbRs7ioghymhR8jVF',
                'number' => 'JLKJLKJLK',
                'website' => 'LKJLKJ',
                'niche' => 'lkjlkj',
                'email' => NULL,
                'rating' => NULL,
                'status' => 0,
                'contacted_at' => null,
                'contacted_by' => null,
                'created_at' => '2023-07-24 10:59:43',
                'updated_at' => '2023-07-24 10:59:43',
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 1,
                'name' => 'Virgie Fuller',
                'address' => 'yHEIieXYSdTAL6jFbXin',
                'number' => 'KJLKSDJFLKJLK',
                'website' => 'JLKJLKDJFLKJ',
                'niche' => 'lkjlkj',
                'email' => NULL,
                'rating' => NULL,
                'status' => 0,
                'contacted_at' => null,
                'contacted_by' => null,
                'created_at' => '2023-07-24 10:59:43',
                'updated_at' => '2023-07-24 11:00:50',
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => 1,
                'name' => 'Gene Stewart',
                'address' => 'W5Q1l8V7KL49MPF',
                'number' => 'JSDKLFJ',
                'website' => 'LKNL',
                'niche' => 'lkjlkj',
                'email' => NULL,
                'rating' => NULL,
                'status' => 0,
                'contacted_at' => null,
                'contacted_by' => null,
                'created_at' => '2023-07-24 10:59:43',
                'updated_at' => '2023-07-24 11:00:49',
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => 1,
                'name' => 'Eugenia Saunders',
                'address' => 'jIzZ2sTxCq1Mw5Uwpbw',
                'number' => 'JKLJFD',
                'website' => 'JLKJ',
                'niche' => 'lkjlkj',
                'email' => NULL,
                'rating' => NULL,
                'status' => 0,
                'contacted_at' => null,
                'contacted_by' => null,
                'created_at' => '2023-07-24 10:59:43',
                'updated_at' => '2023-07-24 10:59:43',
            ),
        ));
        
        
    }
}