<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('speies')->nullable();
            $table->enum('sex', array('ผู้', 'เมีย'));
            $table->string('age')->nullable();
            $table->string('scar')->nullable();
            $table->string('allergy')->nullable();

            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')
            ->references('id')
            ->on('customers')
            ->onDelete('cascade');

            $table->unsignedInteger('pettype_id');
            $table->foreign('pettype_id')
            ->references('id')
            ->on('pettypes')
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
        Schema::dropIfExists('pets');
    }
}
