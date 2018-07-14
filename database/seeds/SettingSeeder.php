<?php

use Illuminate\Database\Seeder;
use App\Setting;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $setting = new Setting;
      $setting->name = "Company LTD";
      $setting->address = "71 Green Street Manahawkin, NJ 08050";
      $setting->tel = "02-xxxxxxx";
      $setting->save();
    }
}
