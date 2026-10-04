<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('invoice_id');
            $table->decimal('total', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->decimal('pay', 10, 2);
            $table->decimal('due', 10, 2);
            $table->text('payment_method');
            $table->text('delivery_note')->nullable();
            $table->text('supplier_ref')->nullable();
            $table->text('other_ref')->nullable();
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
        Schema::dropIfExists('sells');
    }
}
