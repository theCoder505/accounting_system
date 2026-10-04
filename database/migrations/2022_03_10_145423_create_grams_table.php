<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grams', function (Blueprint $table) {
            $table->id();
            $table->integer('division_id');
            $table->integer('zila_id');
            $table->integer('upazila_id');
            $table->integer('union_id');
            $table->string('name')->nullable();
            $table->string('name_bn')->nullable();
            $table->string('slug')->nullable();
            $table->string('slug_bn')->nullable();
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
        Schema::dropIfExists('grams');
    }
}
