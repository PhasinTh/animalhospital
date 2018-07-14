<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(EmptypeSeeder::class);
        $this->call(DayofWeekSeeder::class);
        $this->call(PettypeSeeder::class);
        $this->call(DrugTypeSeeder::class);
        $this->call(SettingSeeder::class);
    }
}
