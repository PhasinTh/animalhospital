<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DayofWeeksEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('dayof_week_employee', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('dayof_week_id');
          $table->foreign('dayof_week_id')
          ->references('id')
          ->on('dayof_weeks')
          ->onDelete('cascade');

          $table->unsignedInteger('employee_id');
          $table->foreign('employee_id')
          ->references('id')
          ->on('users')
          ->onDelete('cascade');
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
        Schema::dropIfExists('dayof_week_employee');
    }
}
