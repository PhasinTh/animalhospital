<?php

use Illuminate\Database\Seeder;
use App\DrugType;
class DrugTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $drug =  new DrugType;
      $drug->name = "ยา";
      $drug->save();

      $drug2 =  new DrugType;
      $drug2->name = "ค่ารักษา";
      $drug2->save();
    }
}
