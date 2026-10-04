<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoronaUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corona_updates', function (Blueprint $table) {
            $table->id();
            $table->string('w_total_case');
            $table->string('w_total_death');
            $table->string('w_total_recover');
            $table->string('bd_total_case');
            $table->string('bd_total_death');
            $table->string('bd_total_recover');
            $table->integer('status');
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
        Schema::dropIfExists('corona_updates');
    }
}
