<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('brand');
            $table->string('description');
            $table->float('price');
            $table->string('author');
            $table->integer('isbn');
            //$table->string('imageurl');
            $table->string('file_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('products');
    }
}