<?php

use Illuminate\Database\Seeder;

class userB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_b')->delete();
        DB::table('users_b')->insert([
            ['id'=>1,'user_id_a'=>'1','user_id_b'=>'1','name'=>'B1','phone'=>'12345678','password'=>bcrypt('123456'),'address'=>'Thường tín','avatar'=>'','state'=>1,'date_in'=>'2020-06-12 00:00:00','date_out'=>'2020-09-14 00:00:00'],
            ['id'=>2,'user_id_a'=>'1','user_id_b'=>'2','name'=>'B2','phone'=>'87654321','password'=>bcrypt('123456'),'address'=>'Thường tín','avatar'=>'','state'=>1,'date_in'=>'2020-07-12 00:00:00','date_out'=>'2021-07-14 00:00:00']
        ]);
    }
}