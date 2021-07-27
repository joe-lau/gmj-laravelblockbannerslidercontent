<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LaravelBlockBannerSliderContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ElementTemplate::insert(
            [
                "title" => "Laravel Block Banner Slider Content",
                "type" => "default",
                "element_name" => "laravel_block_banner_slider_content",
                "component" => "laravelblockbannerslidercontent-frontend",
                "is_multi" => 0,
            ]
        );
    }
}
