<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedDecimal('original_price', 10, 2);
            $table->unsignedDecimal('price', 10, 2);
            $table->string('attr1', 50)->nullable();
            $table->string('attr2', 50)->nullable();
            $table->string('attr3', 50)->nullable();
            $table->integer('quantity');
            $table->integer('sort');
            $table->char('status', 1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skus');
    }
}
