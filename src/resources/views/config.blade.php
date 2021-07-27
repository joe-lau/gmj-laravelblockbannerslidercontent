@extends(config("gmj.backend.layout_path"))

@section(config("gmj.backend.content_path"))

    @php
    $breadcrumbs = [
        ['name' => 'Element', 'link' => route(config("gmj.backend.element_index_path"))],
        ['name' => $element->slug],
        ['name' => "Banner Sliders Content", "link" => route('laravel_block_banner_slider_content.index', $element_id)],
        ['name' => "Config"]
    ];
    @endphp
    <x-backend.breadcrumb :breadcrumbs="$breadcrumbs" />

    <div>
        <form id="myForm" method="POST"
            action="{{ route('laravel_block_banner_slider_content.config2', $element_id) }}" class="relative" enctype="multipart/form-data">

            <x-backend.required />

            @csrf
            <div class="mt-7">
                <label class="block mb-2 cursor-pointer required">
                    Slider Height
                </label>
                <x-backend.input
                    type="text"
                    name="height"
                    id="height"
                    class="w-full" />
            </div>

            <div class="mt-7 flex">
                <div class="">
                    <x-backend.checkbox value="is_auto_play">
                        Auto Play
                    </x-backend.checkbox>
                </div>
                <div class="ml-12">
                    <x-backend.checkbox value="have_arrow">
                        Have Arrow
                    </x-backend.checkbox>
                </div>
                <div class="ml-12">
                    <x-backend.checkbox value="have_pagination">
                        Have Pagination
                    </x-backend.checkbox>
                </div>
            </div>


            <div class="mt-7 text-right">
                <x-backend.link href="{{ url()->previous() }}">Back</x-backend.link>
                <x-backend.button class="ml-3">Save</x-backend.button>
            </div>
        </form>
    </div>
@endsection