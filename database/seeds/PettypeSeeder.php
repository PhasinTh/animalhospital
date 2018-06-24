<?php

use Illuminate\Database\Seeder;
use App\Pettype;
class PettypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $dog = new Pettype;
      $dog->name = "หมา";
      $dog->save();

      $cat = new Pettype;
      $cat->name = "แมว";
      $cat->save();
    }
}
