<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('treatmentname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatments');
    }


    /**    public function up()
    {
    Schema::create('diagnosis_code', function (Blueprint $table) {
    $table->increments('id');
    $table->timestamps();
    $table->string('diacode');
    });
    }

     *
     *
     *
     */
}
