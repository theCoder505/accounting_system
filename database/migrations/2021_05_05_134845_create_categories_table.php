<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->integer('parent_id')->default(0);
            $table->string('image')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_title_bn')->nullable();
            $table->text('meta_des')->nullable();
            $table->text('meta_des_bn')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_keywords_bn')->nullable();
            $table->string('meta_image')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
