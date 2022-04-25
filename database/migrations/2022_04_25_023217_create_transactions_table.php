<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('executed_at')->nullable();
            $table->string('status', 100)->nullable()->default('status');
            $table->string('payment_mode', 100)->nullable()->default('payment mode');
            $table->string('transaction_reference', 100)->nullable()->default('transaction reference');

            $table->unsignedBigInteger('order_id')->nullable()->default(12);
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};