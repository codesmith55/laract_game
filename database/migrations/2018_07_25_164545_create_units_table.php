<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('uuid');
            $table->boolean('isHero')->default(true);
            $table->integer('level')->default(2);

            $table->decimal('stat_evocation')->default(2);
            $table->decimal('stat_abjuration')->default(2);
            $table->decimal('stat_divination')->default(2);
            $table->decimal('stat_transmutation')->default(2);
            $table->decimal('stat_symbiosis')->default(2);


            $table->string('convert_evocation')->nullable();
            $table->string('convert_abjuration')->nullable();
            $table->string('convert_divination')->nullable();
            $table->string('convert_transmutation')->nullable();
            $table->string('convert_symbiosis')->nullable();


            $table->string('initial_evocation')->nullable();
            $table->string('initial_abjuration')->nullable();
            $table->string('initial_divination')->nullable();
            $table->string('initial_transmutation')->nullable();
            $table->string('initial_symbiosis')->nullable();

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
        Schema::dropIfExists('units');
    }
}
