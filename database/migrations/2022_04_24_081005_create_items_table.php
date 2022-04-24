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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 100)->nullable()->default('item name');
            $table->text('description')->nullable();
            $table->string('type', 100)->nullable()->default('type');
            $table->unsignedInteger('price')->unsigned()->nullable()->default(12);
            $table->unsignedInteger('quantity_in_stock')->unsigned()->nullable()->default(12);
            $table->unsignedBigInteger('sub_category_id')->nullable()->default(12);
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};