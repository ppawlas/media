<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectricityChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electricity_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->date('applies_from')->nullable();
            $table->date('applies_to')->nullable();
            $table->decimal('component_c', 9, 6);
            $table->decimal('component_ssvn', 9, 6);
            $table->decimal('component_szvnk', 9, 6);
            $table->decimal('component_sop', 9, 6);
            $table->decimal('component_sosj', 9, 6);
            $table->decimal('component_os', 9, 6);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('electricity_charges');
    }
}
