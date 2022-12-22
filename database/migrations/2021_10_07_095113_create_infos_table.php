<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo', 100)->default('null');
            $table->string('contact_no', 100)->default('017......77');
            $table->string('email', 200)->default('myshop24@gmail.com');
            $table->string('open_hour', 100)->default('24 hours open ');
            $table->string('address', 200)->default('House No 8, Fith floor, Block 23 A, Twiinburge, USA');
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
        Schema::dropIfExists('infos');
    }
}
