<?php

use Illuminate\Database\Seeder;

class category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        DB::table('categories')->insert([
            ['id'=>1,'categories'=>'iphone','images_categories'=>'iphone-logo.png','name'=>'0'],
            ['id'=>2,'categories'=>'iphone-X','images_categories'=>'','name'=>'1'],
            ['id'=>3,'categories'=>'iphone-XS','images_categories'=>'','name'=>'2'],
            ['id'=>4,'categories'=>'SamSung','images_categories'=>'samsung.png','name'=>'0'],
            ['id'=>5,'categories'=>'SamSung-Note','images_categories'=>'','name'=>'4'],
            ['id'=>6,'categories'=>'SamSung-S','images_categories'=>'','name'=>'4'],
            ['id'=>7,'categories'=>'Sony','images_categories'=>'sony.jpg','name'=>'0'],
            ['id'=>8,'categories'=>'Sony-XZ','images_categories'=>'','name'=>'7'],
            ['id'=>9,'categories'=>'Sony-XA','images_categories'=>'','name'=>'8'],
            ['id'=>10,'categories'=>'Sony-XL','images_categories'=>'','name'=>'7'],
            ['id'=>11,'categories'=>'Oppo','images_categories'=>'oppo.jpg','name'=>'0']
        ]);
    }
}
