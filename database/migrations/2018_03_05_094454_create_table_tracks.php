<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTracks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('status')->default('Pending');
            $table->float('count')->default('0');
            $table->timestamps();
        });
    }

   public function down()
    {
        Schema::drop('tracks');
    }
}
