<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_collections', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->string('date');
            $table->integer('company_id');
            $table->decimal('per_month_amount', 10,2);
            $table->integer('year');
            $table->decimal('total_pay', 10,2);
            $table->decimal('total_due', 10,2);
            $table->integer('status')->comment('1=Complete, 0=Due');
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
        Schema::dropIfExists('monthly_collections');
    }
}
