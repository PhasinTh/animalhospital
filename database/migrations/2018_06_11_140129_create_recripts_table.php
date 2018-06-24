<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recripts', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('prescription_id');
            $table->foreign('prescription_id')
            ->references('id')
            ->on('prescriptions')
            ->onDelete('cascade');

            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')
            ->references('id')
            ->on('employees')
            ->onDelete('cascade');

            $table->double('total',8,2);
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recripts');
    }
}
