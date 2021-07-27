<div class="swiper-container banner_slider_content" id="banner_slider_content_{{$id}}">
    <div class="swiper-wrapper">
        @foreach ($sliders as $slider)
            <div class="swiper-slide {{ $slider->animation }}">
                <img src="{{$slider->getMedia("laravel_block_banner_slider_content")->first()->getUrl() }}" alt="">
                {!! $slider->getTranslation("content", "en") !!}
            </div>
        @endforeach
    </div>
    @if($config->have_pagination)
        <div class="swiper-pagination"></div>
    @endif
    @if($config->have_arrow)
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    @endif
</div>

@once
    @push(config('gmj.frontend.push_css_path'))
        <link rel="stylesheet" href="{{ asset("gmj/css/swiper.min.css") }}" />
        <style>
            .banner_slider_content .fade-up .banner_slider_content_content {
                opacity: 0;
                transform: translateY(40px);
            }

            .swiper-slide-active.fade-up .banner_slider_content_content{
                animation: fadeIn 0.6s forwards;
                animation-delay: 0.8s;
            }

            @keyframes fadeIn {
                0% {
                    opacity: 0;
                    transform: translateY(40px);
                }
                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    @endpush
@endonce

@push(config('gmj.frontend.push_js_path'))
    @once
        <script src="{{ asset("gmj/js/swiper.min.js") }}"></script>
    @endonce
    <script>
        var swiper = new Swiper("#banner_slider_content_{{$id}}", {
            @if($config->is_auto_play)
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                speed: 800,
                loop:true,
            @endif
            @if($config->have_pagination)
                pagination: {
                    el: ".swiper-pagination",
                },
            @endif
            @if($config->have_arrow)
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            @endif
        });
    </script>
@endpush
