<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('name_bangla');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('author_product', function (Blueprint $table) {
            $table->integer('author_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('author_type')->unsigned();

            $table->foreign('author_id')->references('id')->on('authors')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['author_id', 'product_id', 'author_type']);
        });

        // Schema::create('product_translator', function (Blueprint $table) {
        //     $table->integer('author_id')->unsigned();
        //     $table->integer('product_id')->unsigned();

        //     $table->foreign('author_id')->references('id')->on('authors')
        //         ->onUpdate('cascade')->onDelete('cascade');
        //     $table->foreign('product_id')->references('id')->on('products')
        //         ->onUpdate('cascade')->onDelete('cascade');

        //     $table->primary(['author_id', 'product_id']);
        // });

        // Schema::create('product_editor', function (Blueprint $table) {
        //     $table->integer('author_id')->unsigned();
        //     $table->integer('product_id')->unsigned();

        //     $table->foreign('author_id')->references('id')->on('authors')
        //         ->onUpdate('cascade')->onDelete('cascade');
        //     $table->foreign('product_id')->references('id')->on('products')
        //         ->onUpdate('cascade')->onDelete('cascade');

        //     $table->primary(['author_id', 'product_id']);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors');
        Schema::dropIfExists('author_product');
    }
}
