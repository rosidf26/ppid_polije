<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlideshowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slideshows', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('image');
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->string('link')->nullable();
            $table->integer('page_id')->nullable();
            $table->integer('order')->nullable();
            $table->tinyInteger('advanced_mode')->nullable();
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
        Schema::dropIfExists('slideshows');
    }
}
