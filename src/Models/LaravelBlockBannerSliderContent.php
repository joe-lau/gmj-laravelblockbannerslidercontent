<?php

namespace GMJ\LaravelBlockBannerSliderContent\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LaravelBlockBannerSliderContent extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasTranslations;

    protected $guarded = [];
    public $translatable = ['content'];

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection("laravel_block_banner_slider_content")->singleFile();
    }

    public function config()
    {
        $this->belongsTo(LaravelBlockBannerSliderContentConfig::class);
    }
}
