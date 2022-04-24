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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('status', 100)->nullable()->default('status');
            $table->unsignedInteger('total_value')->unsigned()->nullable()->default(12);
            $table->unsignedInteger('taxes')->unsigned()->nullable()->default(12);
            $table->unsignedInteger('shipping_charges')->unsigned()->nullable()->default(12);
            $table->unsignedBigInteger('user_id')->nullable()->default(12);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};