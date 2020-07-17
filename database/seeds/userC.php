<?php

use Illuminate\Database\Seeder;

class userC extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_c')->delete();
        DB::table('users_c')->insert([
            ['id'=>1,'user_id_b'=>'1','user_id_c'=>'1','name'=>'C1','phone'=>'11111111','password'=>bcrypt('123456'),'address'=>'Thường tín','avatar'=>'ash.jpg','state'=>1,'date_in'=>'2020-06-12 00:00:00','date_out'=>'2020-09-14 00:00:00'],
            ['id'=>2,'user_id_b'=>'1','user_id_c'=>'2','name'=>'C2','phone'=>'22222222','password'=>bcrypt('123456'),'address'=>'Thường tín','avatar'=>'chimera.jpg','state'=>1,'date_in'=>'2020-06-15 00:00:00','date_out'=>'2021-07-22 00:00:00'],
            ['id'=>3,'user_id_b'=>'2','user_id_c'=>'3','name'=>'C3','phone'=>'33333333','password'=>bcrypt('123456'),'address'=>'Thường tín','avatar'=>'nakkroth4.jpg','state'=>1,'date_in'=>'2020-07-12 00:00:00','date_out'=>'2021-09-24 00:00:00'],
            ['id'=>4,'user_id_b'=>'2','user_id_c'=>'4','name'=>'C4','phone'=>'44444444','password'=>bcrypt('123456'),'address'=>'Thường tín','avatar'=>'superman1.jpg','state'=>1,'date_in'=>'2020-09-12 00:00:00','date_out'=>'2023-04-11 00:00:00']
        ]);
    }
}