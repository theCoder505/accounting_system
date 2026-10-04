<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->string('type');
            $table->string('date');
            $table->integer('category_id');
            $table->integer('company_id')->nullable();
            $table->string('title');
            $table->decimal('total', 10,2);
            $table->decimal('amount', 10,2);
            $table->decimal('due', 10,2);
            $table->string('vouchar_image')->nullable();
            $table->integer('status')->comment('1=Paid, 0-Due');
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
        Schema::dropIfExists('income_expenses');
    }
}
