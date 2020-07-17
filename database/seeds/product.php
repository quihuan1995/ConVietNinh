<?php

use Illuminate\Database\Seeder;

class product extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
        DB::table('products')->insert([
          ['id'=>1,'images_product'=>'iphone8.jpg','name_product'=>'Iphone 8','price_product'=>18000000,'is_sale'=>0,'price_product_sale'=>15000000,'quantity'=>1,'start_discount'=>'2020-06-05 00:00:00','stop_discount'=>'2020-06-05 00:00:00','type_product'=>1,'menu_id'=>01,'sku'=>0,'content'=>'','active'=>2,'categories_id'=>1],
          ['id'=>2,'images_product'=>'iphoneX64.png','name_product'=>'Iphone X64','price_product'=>25000000,'is_sale'=>0,'price_product_sale'=>20000000,'quantity'=>1,'start_discount'=>'2020-06-05 00:00:00','stop_discount'=>'2020-06-05 00:00:00','type_product'=>2,'menu_id'=>02,'sku'=>0,'content'=>'','active'=>1,'categories_id'=>2],
          ['id'=>3,'images_product'=>'iphoneXR.jpg','name_product'=>'Iphone XR','price_product'=>30000000,'is_sale'=>0,'price_product_sale'=>25000000,'quantity'=>1,'start_discount'=>'2020-06-05 00:00:00','stop_discount'=>'2020-06-05 00:00:00','type_product'=>3,'menu_id'=>03,'sku'=>0,'content'=>'','active'=>1,'categories_id'=>3],
          ['id'=>4,'images_product'=>'iphonegold.jpg','name_product'=>'Iphone Gold','price_product'=>16000000,'is_sale'=>0,'price_product_sale'=>12000000,'quantity'=>1,'start_discount'=>'2020-06-05 00:00:00','stop_discount'=>'2020-06-05 00:00:00','type_product'=>1,'menu_id'=>04,'sku'=>0,'content'=>'','active'=>2,'categories_id'=>1],
          ['id'=>5,'images_product'=>'samsungS9.png','name_product'=>'SamSung S9','price_product'=>19000000,'is_sale'=>0,'price_product_sale'=>15000000,'quantity'=>1,'start_discount'=>'2020-06-05 00:00:00','stop_discount'=>'2020-06-05 00:00:00','type_product'=>6,'menu_id'=>05,'sku'=>0,'content'=>'','active'=>1,'categories_id'=>6],
          ['id'=>6,'images_product'=>'samsungS10.png','name_product'=>'SamSung S10','price_product'=>20000000,'is_sale'=>0,'price_product_sale'=>17000000,'quantity'=>1,'start_discount'=>'2020-06-05 00:00:00','stop_discount'=>'2020-06-05 00:00:00','type_product'=>6,'menu_id'=>06,'sku'=>0,'content'=>'','active'=>1,'categories_id'=>6],
          ['id'=>7,'images_product'=>'samsungA70.png','name_product'=>'SamSung A70','price_product'=>5000000,'is_sale'=>0,'price_product_sale'=>1000000,'quantity'=>1,'start_discount'=>'2020-06-05 00:00:00','stop_discount'=>'2020-06-05 00:00:00','type_product'=>4,'menu_id'=>07,'sku'=>0,'content'=>'','active'=>2,'categories_id'=>4],
             ['id'=>8,'images_product'=>'samsungNote10.jpg','name_product'=>'SamSung Note 10','price_product'=>22000000,'is_sale'=>0,'price_product_sale'=>19000000,'quantity'=>1,'start_discount'=>'2020-06-05 00:00:00','stop_discount'=>'2020-06-05 00:00:00','type_product'=>5,'menu_id'=>06,'sku'=>0,'content'=>'','active'=>1,'categories_id'=>5],
          ['id'=>9,'images_product'=>'sonyx5.png','name_product'=>'Sony XA1','price_product'=>17000000,'is_sale'=>0,'price_product_sale'=>15000000,'quantity'=>1,'start_discount'=>'2020-06-05 00:00:00','stop_discount'=>'2020-06-05 00:00:00','type_product'=>9,'menu_id'=>07,'sku'=>0,'content'=>'','active'=>1,'categories_id'=>9],
           ['id'=>10,'images_product'=>'sonyxz2.png','name_product'=>'Sony XZ2','price_product'=>4000000,'is_sale'=>0,'price_product_sale'=>2000000,'quantity'=>1,'start_discount'=>'2020-06-05 00:00:00','stop_discount'=>'2020-06-05 00:00:00','type_product'=>8,'menu_id'=>10,'sku'=>0,'content'=>'','active'=>2,'categories_id'=>8],
           ['id'=>11,'images_product'=>'sonyxz4.png','name_product'=>'Sony XZ4','price_product'=>6000000,'is_sale'=>0,'price_product_sale'=>6000000,'quantity'=>1,'start_discount'=>'2020-06-05 00:00:00','stop_discount'=>'2020-06-05 00:00:00','type_product'=>8,'menu_id'=>11,'sku'=>0,'content'=>'','active'=>2,'categories_id'=>8],
           ['id'=>12,'images_product'=>'sonyxl4.jpg','name_product'=>'Sony XL','price_product'=>12000000,'is_sale'=>0,'price_product_sale'=>10000000,'quantity'=>1,'start_discount'=>'2020-06-05 00:00:00','stop_discount'=>'2020-06-05 00:00:00','type_product'=>10,'menu_id'=>12,'sku'=>0,'content'=>'','active'=>1,'categories_id'=>10],
          ['id'=>13,'images_product'=>'oppoRealme5.jpg','name_product'=>'Oppo RealMe 5','price_product'=>10000000,'is_sale'=>0,'price_product_sale'=>6000000,'quantity'=>1,'start_discount'=>'2020-06-05 00:00:00','stop_discount'=>'2020-06-05 00:00:00','type_product'=>11,'menu_id'=>01,'sku'=>0,'content'=>'','active'=>1,'categories_id'=>11],

          ]);
    }
}