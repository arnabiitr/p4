<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

           $table->integer('member_id')->unsigned();
           // $table->foreign('member_id')->references('id')->on('members');
            $table->string('diagnosis_code');
            $table->integer('total_amount');
            $table->integer('amount_paid');
            $table->integer('status');



        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claims');
    }
}
