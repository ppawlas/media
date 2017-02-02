<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableElectricityChargesDefaults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('electricity_charges', function (Blueprint $table) {
            $table->decimal('component_c', 9, 6)->default(0)->change();
            $table->decimal('component_ssvn', 9, 6)->default(0)->change();
            $table->decimal('component_szvnk', 9, 6)->default(0)->change();
            $table->decimal('component_sop', 9, 6)->default(0)->change();
            $table->decimal('component_sosj', 9, 6)->default(0)->change();
            $table->decimal('component_os', 9, 6)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('electricity_charges', function (Blueprint $table) {
            $table->decimal('component_c', 9, 6)->default(null)->change();
            $table->decimal('component_ssvn', 9, 6)->default(null)->change();
            $table->decimal('component_szvnk', 9, 6)->default(null)->change();
            $table->decimal('component_sop', 9, 6)->default(null)->change();
            $table->decimal('component_sosj', 9, 6)->default(null)->change();
            $table->decimal('component_os', 9, 6)->default(null)->change();
        });
    }
}
