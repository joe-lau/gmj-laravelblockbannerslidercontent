<?php

namespace GMJ\LaravelBlockBannerSliderContent\View\Components;

use GMJ\LaravelBlockBannerSliderContent\Models\LaravelBlockBannerSliderContent;
use GMJ\LaravelBlockBannerSliderContent\Models\LaravelBlockBannerSliderContentConfig;
use Illuminate\View\Component;

class Frontend extends Component
{
    public $sliders = [];
    public $id;
    public $config;
    public function __construct($id)
    {
        $this->id = $id;
        $this->config = LaravelBlockBannerSliderContentConfig::where("element_id", $id)->first();
        $this->sliders = LaravelBlockBannerSliderContent::where("element_id", $id)->orderBy("display_order")->get();
    }

    public function render()
    {
        return view("laravelblockbannerslidercontent::components.frontend.show");
    }
}
