<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_details', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('prescription_id');
            $table->foreign('prescription_id')
            ->references('id')
            ->on('prescriptions')
            ->onDelete('cascade');

            $table->unsignedInteger('drug_id');
            $table->foreign('drug_id')
            ->references('id')
            ->on('drugs')
            ->onDelete('cascade');

            $table->unsignedInteger('quantity');

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
        Schema::dropIfExists('prescription_details');
    }
}
