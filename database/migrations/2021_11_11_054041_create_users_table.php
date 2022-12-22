<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->string('email')->default('');
            $table->string('password');
            $table->string('addr')->default('');
            $table->string('dlv_time')->default('');
            $table->integer('point')->default(0);
            $table->integer('balance')->default(0);
            $table->string('type')->default('');
            $table->integer('ref_id')->unique();
            $table->integer('hand')->default(0);
            $table->integer('reffered')->default(0);
            $table->string('who_refered')->default('');
            $table->string('who_ref_name')->default('');
            $table->integer('ref_bonus')->default(0);
            $table->integer('updating_bal')->default(0);
            $table->integer('lvl_bonus')->default(0);
            $table->integer('lgb')->default(0);
            $table->integer('dis_bal')->default(0);
            $table->integer('shopable')->default(0);
            $table->integer('withdrawable')->default(0);
            $table->string('withdraw_applied_on')->default('');
            $table->string('shop_applied_on')->nullable()->default('');
            $table->tinyInteger('lvl')->default(0);
            $table->string('payment_method')->default('');
            $table->string('payment_no')->default('');
            $table->string('tranx')->nullable()->default('');
            $table->integer('tranx_amount')->default(0);
            $table->string('comments')->nullable()->default('');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
