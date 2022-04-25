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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamp('raised_at')->nullable();
            $table->string('status', 100)->nullable()->default('status');
            $table->unsignedInteger('totalAmount')->unsigned()->nullable()->default(12);

            $table->unsignedBigInteger('order_id')->nullable()->default(12);
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};