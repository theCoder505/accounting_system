<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('company_id');
            $table->text('name');
            $table->integer('project_budget')->default(0);
            $table->integer('total_pay')->default(0);
            $table->integer('total_due')->default(0);
            $table->integer('technology_id');
            $table->integer('category_id');
            $table->string('start_date')->nullable();
            $table->string('delivery_date')->nullable();
            $table->text('domain_name')->nullable();
            $table->string('domain_expire_date')->nullable();
            $table->text('admin_details_entry')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
