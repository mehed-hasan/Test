<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('p_name');
            $table->string('sku', 100);
            $table->string('cat_name', 100);
            $table->string('sub_cat', 100);
            $table->string('sub_sub_cat', 100);
            $table->integer('buying_price')->default(0);
            $table->integer('before_price')->default(0);
            $table->integer('recent_price');
            $table->string('color', 100)->default('');
            $table->string('size', 100)->default('');
            $table->string('brand', 100)->default('');
            $table->integer('stock');
            $table->longText('short_desc');
            $table->longText('long_desc');
            $table->integer('sold')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->integer('viewed')->default(0);
            $table->string('uploaded_by', 100);
            $table->string('status', 100)->nullable()->default('active');
            $table->string('unit');
            $table->string('tag');
            $table->integer('point');
            $table->integer('shiping_day');
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
        Schema::dropIfExists('products');
    }
}
