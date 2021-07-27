@extends(config("gmj.backend.layout_path"))

@section(config("gmj.backend.content_path"))

    @php
    $breadcrumbs = [
        ['name' => 'Element', 'link' => route(config("gmj.backend.element_index_path"))],
        ['name' => $element->slug],
        ['name' => "Banner Sliders Content", "link" => route('laravel_block_banner_slider.index', $element_id)],
        ['name' => "Order"]
    ];
    @endphp
    <x-backend.breadcrumb :breadcrumbs="$breadcrumbs" />


    <div class="text-right mb-6">
        <x-backend.button form="myForm">
            Save
        </x-backend.button>
        <x-backend.link href="{{ url()->previous() }}">
            Back
        </x-backend.link>
    </div>

    <form id="myForm" method="POST"
        action="{{ route('laravel_block_banner_slider_content.order2', $element_id) }}">
        @csrf
        <div id="menu-list">
            @foreach ($sliders as $slider)
                <div class="py-3 px-6 text-white rounded-md w-full mt-4 cursor-move">
                    <img src="{{ $slider->getMedia('laravel_block_banner_slider_content')->first()->getUrl() }}" alt="" class="w-96">
                    <input type="hidden" name="id[]" value="{{ $slider->id }}">
                </div>
            @endforeach
        </div>
    </form>
@endsection

@push(config("gmj.backend.push_js_path"))
    <script>
        $(function() {
            $("#menu-list").sortable();
        });
    </script>
@endpush
