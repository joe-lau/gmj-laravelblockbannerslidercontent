<?php

use GMJ\LaravelBlockBannerSliderContent\Http\Controllers\LaravelBlockBannerSliderContentController;

Route::group([
    "namespace" => "GMJ\LaravelBlockBannerSlider\Http\Controllers",
    "prefix" => "admin/element/{element_id}/gmj/laravel_block_banner_slider_content",
    "as" => "laravel_block_banner_slider_content."
], function () {
    Route::get("index", [LaravelBlockBannerSliderContentController::class, "index"])->name("index");
    Route::get("create", [LaravelBlockBannerSliderContentController::class, "create"])->name("create");
    Route::post("create", [LaravelBlockBannerSliderContentController::class, "store"])->name("store");
    Route::get("edit/{id}", [LaravelBlockBannerSliderContentController::class, "edit"])->name("edit");
    Route::patch("edit/{id}", [LaravelBlockBannerSliderContentController::class, "update"])->name("update");
    Route::get("order", [LaravelBlockBannerSliderContentController::class, "order"])->name("order");
    Route::post("order", [LaravelBlockBannerSliderContentController::class, "order2"])->name("order2");
    Route::post("config2", [LaravelBlockBannerSliderContentController::class, "config2"])->name("config2");
    Route::delete("destroy/{id}", [LaravelBlockBannerSliderContentController::class, "destroy"])->name("destroy");
});

Route::group([
    "namespace" => "GMJ\LaravelBlockBannerSlider\Http\Controllers"
], function () {
    Route::get("gmj/laravel_block_banner_slider/demo", [LaravelBlockBannerSliderController::class, "demo"])->name("demo");
});
