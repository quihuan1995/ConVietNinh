<?php

use Illuminate\Database\Seeder;

class userD extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_d')->delete();
        DB::table('users_d')->insert([
            ['id'=>1,'user_id_c'=>'1','user_id_d'=>'1','name'=>'D1','phone'=>'5555555','password'=>bcrypt('123456'),'address'=>'Thường tín','avatar'=>'','state'=>1,'date_in'=>'2020-06-12 00:00:00','date_out'=>'2020-09-14 00:00:00'],

        ]);
    }
}