<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Rooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('rooms', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->integer('created_by');
          $table->string('token')->nullable();
          $table->string('rtc_room_name')->nullable();
          $table->string('rtc_room_creator')->nullable();
          $table->boolean('public');
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
        Schema::dropIfExists('rooms');
    }
}
