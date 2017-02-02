<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableElectricityChargesDropDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('electricity_charges', function (Blueprint $table) {
            $table->dropColumn('applies_from');
            $table->dropColumn('applies_to');
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
            $table->date('applies_from')->nullable();
            $table->date('applies_to')->nullable();
        });
    }
}
