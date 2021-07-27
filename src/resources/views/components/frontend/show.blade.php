<div class="swiper-container" id="banner_slider_{{$id}}">
    <div class="swiper-wrapper">
        @foreach ($sliders as $slider)
            <div class="swiper-slide">
                <img src="{{$slider->getMedia("laravel_block_banner_slider")->first()->getUrl() }}" alt="">
            </div>
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

@once
    @push(config('gmj.frontend.push_css_path'))
        <link rel="stylesheet" href="{{ asset("gmj/css/swiper.min.css") }}" />
    @endpush
@endonce

@push(config('gmj.frontend.push_js_path'))
    @once
        <script src="{{ asset("gmj/js/swiper.min.js") }}"></script>
    @endonce
    <script>
        var swiper = new Swiper("#banner_slider_{{$id}}", {
            pagination: {
                el: ".swiper-pagination",
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
@endpush
