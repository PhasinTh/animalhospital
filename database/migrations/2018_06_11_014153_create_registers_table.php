<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('emp_id');
            $table->foreign('emp_id')
            ->references('id')
            ->on('employees')
            ->onDelete('cascade');

            $table->unsignedInteger('pet_id');
            $table->foreign('pet_id')
            ->references('id')
            ->on('pets')
            ->onDelete('cascade');

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
        Schema::dropIfExists('registers');
    }
}
