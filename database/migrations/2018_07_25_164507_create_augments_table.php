<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAugmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('augments', function (Blueprint $table) {
            $table->increments('id');
//            $table->string('uuid');

            $table->timestamps();

            $table->string("type");
            $table->string("level");
            $table->string("cost");//?
            $table->string("initial");//effect type//bonus for first element use
            $table->string("convert");//effect type//bonus for each element use
            $table->string("stat_adjust");//effect type
            $table->integer("monster_hp")->nullable();//effect type


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('augments');
    }
}
