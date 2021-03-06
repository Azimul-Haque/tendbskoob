<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('publisher_id')->after('brand_id')->nullable();
            $table->string('name_bangla')->nullable();
            $table->string('isbn')->nullable();
            $table->string('weight')->nullable();
            $table->string('published_price')->default(0);
            $table->integer('stock_status');
            // $table->integer('writer_id')->after('publisher_id')->nullable();
            // $table->integer('translator_id')->after('writer_id')->nullable();
            // $table->integer('editor_id')->after('translator_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
