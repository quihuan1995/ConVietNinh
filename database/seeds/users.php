<?php

use Illuminate\Database\Seeder;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            ['id'=>1,'name'=>'A','email'=>'admin@gmail.com','phone'=>'12345678','password'=>bcrypt('123456'),'address'=>'Thường tín','avatar'=>'','admin'=>1,
            'create_product'=>0,'api_token'=>0,'total_points'=>0,'points_thicong'=>0,'points_vattu'=>0,'total_order'=>0,'active'=>0
            ]

        ]);
    }
}