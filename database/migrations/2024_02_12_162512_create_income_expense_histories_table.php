<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeExpenseHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_expense_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('income_expense_id');
            $table->string('type');
            $table->string('date');
            $table->integer('category_id');
            $table->integer('company_id')->nullable();
            $table->decimal('total', 10,2);
            $table->decimal('pay', 10,2);
            $table->decimal('due', 10,2);
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
        Schema::dropIfExists('income_expense_histories');
    }
}
