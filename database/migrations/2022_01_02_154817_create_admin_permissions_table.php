<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id');
            $table->string('dashboard')->nullable();
            $table->string('category_create')->nullable();
            $table->string('category_edit')->nullable();
            $table->string('category_delete')->nullable();
            $table->string('tag_create')->nullable();
            $table->string('tag_edit')->nullable();
            $table->string('tag_delete')->nullable();
            $table->string('subject_create')->nullable();
            $table->string('subject_edit')->nullable();
            $table->string('subject_delete')->nullable();
            $table->string('banner_create')->nullable();
            $table->string('banner_edit')->nullable();
            $table->string('banner_delete')->nullable();
            $table->string('post_create')->nullable();
            $table->string('post_edit')->nullable();
            $table->string('post_delete')->nullable();
            $table->string('website_settings')->nullable();
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
        Schema::dropIfExists('admin_permissions');
    }
}
