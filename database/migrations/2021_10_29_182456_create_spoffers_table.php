<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateSpoffersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('spoffers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('heading')->default('');
            $table->string('link')->default('');
            $table->string('offer_ended_at')->default('00');
            $table->string('cover_img')->default('null');
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
        Schema::dropIfExists('spoffers');
    }
}
