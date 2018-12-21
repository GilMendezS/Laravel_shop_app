<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();

        });
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->boolean('featured')->default(FALSE);
            $table->integer('price');
            $table->boolean('inlimited')->default(FALSE);
            $table->integer('stock')->default(1);
            $table->string('number')->nullable();
            $table->string('brand')->nullable();
            $table->string('barcode')->nullable();
            $table->integer('status_id')->unsigned();
            $table->integer('weight')->nullable();
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('images', function(BluePrint $table){
            $table->increments('id');
            $table->string('url');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('images');
        Schema::dropIfExists('products');
    }
}
