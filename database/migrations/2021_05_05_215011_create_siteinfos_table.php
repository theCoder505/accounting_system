<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siteinfos', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->longtext('advertise_ino')->nullable();
            $table->longtext('privacy')->nullable();
            $table->longtext('rules')->nullable();
            $table->longtext('contact')->nullable();
            $table->longtext('google_anlytics_code')->nullable();
            $table->longtext('robots_txt')->nullable();
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
        Schema::dropIfExists('siteinfos');
    }
}
