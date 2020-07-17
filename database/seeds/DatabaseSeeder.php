<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

         $this->call(category::class);
          $this->call(product::class);
         $this->call(users::class);
         $this->call(userB::class);
          $this->call(userC::class);
           $this->call(userD::class);
    }
}