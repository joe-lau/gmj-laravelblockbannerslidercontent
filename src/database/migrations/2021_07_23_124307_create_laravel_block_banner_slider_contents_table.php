<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaravelBlockBannerSliderContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laravel_block_banner_slider_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("element_id");
            $table->longText('content')->nullable();
            $table->string("animation")->nullable();
            $table->integer("display_order");
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
        Schema::dropIfExists('laravel_block_banner_slider_contents');
    }
}
