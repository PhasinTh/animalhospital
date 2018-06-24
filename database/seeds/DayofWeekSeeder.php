<?php

use Illuminate\Database\Seeder;
use App\DayofWeek;

class DayofWeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $mon = new DayofWeek;
      $mon->name = "จันทร์";
      $mon->save();

      $tues = new DayofWeek;
      $tues->name = "อังคาร";
      $tues->save();

      $wed = new DayofWeek;
      $wed->name = "พุธ";
      $wed->save();

      $thur = new DayofWeek;
      $thur->name = "พฤหัสบดี";
      $thur->save();

      $fri = new DayofWeek;
      $fri->name = "ศุกร์";
      $fri->save();

      $sat = new DayofWeek;
      $sat->name = "เสาร์";
      $sat->save();

      $sun = new DayofWeek;
      $sun->name = "อาทิตย์";
      $sun->save();
    }
}
