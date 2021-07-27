<?php

namespace GMJ\LaravelBlockBannerSlider\View\Components;

use GMJ\LaravelBlockBannerSlider\Models\LaravelBlockBannerSlider;
use Illuminate\View\Component;

class Frontend extends Component
{
    public $sliders = [];
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
        $this->sliders = LaravelBlockBannerSlider::where("element_id", $id)->orderBy("display_order")->get();
    }

    public function render()
    {
        return view("laravelblockbannerslider::components.frontend.show");
    }
}
