@extends(config("gmj.backend.layout_path"))

@section(config("gmj.backend.content_path"))

    @php
    $breadcrumbs = [
        ['name' => 'Element', 'link' => route(config("gmj.backend.element_index_path"))],
        ['name' => $element->slug],
        ['name' => "Banner Sliders Content"],
    ];
    @endphp
    <x-backend.breadcrumb :breadcrumbs="$breadcrumbs" />

    <div>
        <div class="flex justify-end">
            <div class="text-right mb-6">
                <x-backend.link href="{{ route('laravel_block_banner_slider_content.create', $element_id) }}">
                    ADD
                </x-backend.link>
                <x-backend.link href="{{ route('laravel_block_banner_slider_content.order', $element_id) }}" class="ml-4">
                    ORDER
                </x-backend.link>
            </div>
        </div>
        <div class="flex space-x-2 bg-gray-500 p-3 border-white border-b-2 text-white">
            <div class="flex-1">Image</div>
            <div class="flex-1">Edit</div>
        </div>
        @isset($sliders)
            @forelse ($sliders as $slider)
                <div class="flex items-center space-x-2 p-3">
                    <div class="flex-1">
                        <img src="{{ $slider->getMedia('laravel_block_banner_slider_content')->first()->getUrl() }}" />
                    </div>
                    <div class="flex-1">
                        <x-backend.link
                            href="{{ route('laravel_block_banner_slider_content.edit', ['element_id' => $element_id, 'id' => $slider->id]) }}">Edit</x-backend.link>
                        <form
                            action="{{ route('laravel_block_banner_slider_content.destroy',['element_id' => $element_id, 'id' => $slider->id]) }}"
                            method="POST" class="inline-block">
                            @csrf
                            @method("DELETE")
                            <x-backend.button class='delete'>
                                Delete
                            </x-backend.button>
                        </form>
                    </div>
                </div>
            @empty
                <div>No Data</div>
            @endforelse
        @endisset
    </div>
@endsection