<?php

use Illuminate\Database\Seeder;
use App\Emptype;

class EmptypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type1 = new Emptype;
        $type1->name = "พนักงานบริการ";
        $type1->save();

        $type2 = new Emptype;
        $type2->name = "สัตวแพทย์";
        $type2->save();

        $type2 = new Emptype;
        $type2->name = "พนักงานการเงิน";
        $type2->save();
    }
}
