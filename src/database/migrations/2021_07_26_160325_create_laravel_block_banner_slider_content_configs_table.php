<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaravelBlockBannerSliderContentConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laravel_block_banner_slider_content_configs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("element_id");
            $table->integer("height");
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
        Schema::dropIfExists('laravel_block_banner_slider_content_onfigs');
    }
}
