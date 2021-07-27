<?php

namespace GMJ\LaravelBlockBannerSliderContent\Http\Controllers;

use App\Http\Controllers\Controller;
use GMJ\LaravelBlockBannerSliderContent\Models\LaravelBlockBannerSliderContent;
use Alert;
use GMJ\LaravelBlockBannerSliderContent\Models\LaravelBlockBannerSliderContentConfig;

class LaravelBlockBannerSliderContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index($element_id)
    {
        $config = LaravelBlockBannerSliderContentConfig::where("element_id", $element_id)->first();
        $element = \App\Models\Element::find($element_id);

        if (!$config) {
            return view("laravelblockbannerslidercontent::config", compact("element", "element_id"));
        }

        $sliders = LaravelBlockBannerSliderContent::where("element_id", $element_id)->orderBy("display_order")->get();
        // dd($sliders->getMedia("laravel_block_banner_slider"));
        return view("laravelblockbannerslidercontent::index", compact("element", "element_id", "sliders"));
    }

    public function config2($element_id)
    {
        request()->validate([
            "height" => "required|integer"
        ]);
        //dd("pass...");
        LaravelBlockBannerSliderContentConfig::create([
            "element_id" => $element_id,
            "height" => request()->height
        ]);
        return redirect()->route("laravel_block_banner_slider_content.index", $element_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($element_id)
    {
        $element = \App\Models\Element::find($element_id);
        $config = LaravelBlockBannerSliderContentConfig::where("element_id", $element_id)->first();
        return view("laravelblockbannerslidercontent::create", compact("element", "element_id", "config"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($element_id)
    {/* 
        foreach (config("translatable.locales") as $locale) {
            $rules["content_{$locale}"] = "required";
        } */

        $rules["image"] = "required|image";
        request()->validate($rules);

        foreach (config("translatable.locales") as $locale) {
            $content[$locale] = request()["content_{$locale}"];
        }

        $display_order = LaravelBlockBannerSliderContent::where("element_id", $element_id)->max("display_order");
        $display_order++;

        $slider = new LaravelBlockBannerSliderContent;
        $slider->element_id = $element_id;
        $slider->content = $content;
        $slider->display_order = $display_order;

        $slider->addMediaFromBase64(request()->uic_base64_image, ["image/jpeg", "image/png"])->toMediaCollection('laravel_block_banner_slider_content');
        $slider->save();

        $element = \App\Models\Element::find($element_id);
        $element->active();
        Alert::toast("Add Element {$element->slug} Laravel Block Banner Slider success", 'success');
        return redirect()->route("laravel_block_banner_slider_content.index", $element_id);
    }

    public function edit($element_id, $id)
    {
        $element = \App\Models\Element::find($element_id);
        $slider = LaravelBlockBannerSliderContent::findOrFail($id);
        $config = LaravelBlockBannerSliderContentConfig::where("element_id", $element_id)->first();
        return view("laravelblockbannerslidercontent::edit", compact("element", "element_id", "slider", "config"));
    }

    public function update($element_id, $id)
    {
        /*         foreach (config("translatable.locales") as $locale) {
            $rules["content_{$locale}"] = "required";
        } */
        /* $rules["image"] = "required|image";
        request()->validate($rules); */

        foreach (config("translatable.locales") as $locale) {
            $content[$locale] = request()["content_{$locale}"];
        }

        $slider = LaravelBlockBannerSliderContent::find($id);
        $slider->content = $content;

        if ((request()->uic_base64_image)) {
            $slider->addMediaFromBase64(request()->uic_base64_image, ["image/jpeg", "image/png"])->toMediaCollection('laravel_block_banner_slider_content');
        }

        $slider->save();

        $element = \App\Models\Element::find($element_id);
        Alert::toast("Edit Element {$element->slug} Laravel Block Banner Slider Content success", 'success');
        return redirect()->route("laravel_block_banner_slider_content.index", $element_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaravelBlockBannerSlider  $laravelBlockBannerSlider
     * @return \Illuminate\Http\Response
     */
    public function destroy($element_id, $id)
    {
        $slider = LaravelBlockBannerSliderContent::find($id);
        $slider->delete();
        $element = \App\Models\Element::find($element_id);
        Alert::toast("Delete Element {$element->slug} Laravel Block Banner Slider Content success", 'success');
        return redirect()->route("laravel_block_banner_slider_content.index", $element_id);
    }

    //demo
    public function demo()
    {
        return view("laravelblockbannerslidercontent::demo");
    }

    public function order($element_id)
    {
        $element = \App\Models\Element::find($element_id);
        $sliders =  LaravelBlockBannerSliderContent::where("element_id", $element_id)->orderBy("display_order")->get();
        return view("laravelblockbannerslidercontent::order", compact("element_id", "element", "sliders"));
    }

    public function order2($element_id)
    {
        foreach (request()->id as $key => $item) {
            $slider = LaravelBlockBannerSliderContent::find($item);
            $num = $key + 1;
            $slider->display_order = $num;
            $slider->save();
        }
        $element = \App\Models\Element::find($element_id);
        Alert::toast("Edit Element {$element->title} Laravel Block Banner Slider Content success", 'success');
        return redirect()->route("laravel_block_banner_slider_content.index", $element_id);
    }
}
