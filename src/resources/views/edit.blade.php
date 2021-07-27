@extends(config("gmj.backend.layout_path"))

@section(config("gmj.backend.content_path"))
    @php
    $breadcrumbs = [
        ['name' => 'Element', 'link' => route(config("gmj.backend.element_index_path"))],
        ['name' => $element->slug],
        ['name' => "Banner Sliders Content", "link" => route('laravel_block_banner_slider_content.index', $element_id)],
        ['name' => "Edit"]
    ];
    @endphp
    <x-backend.breadcrumb :breadcrumbs="$breadcrumbs" />

    <div>
        <form id="myForm" method="POST"
            action="{{ route('laravel_block_banner_slider_content.update', ['element_id' => $element_id, 'id' => $slider->id]) }}" class="relative" enctype="multipart/form-data">

            <x-backend.required />
            @method("patch")
            @csrf
            <div class="mt-4">
                <label class="block mb-2 cursor-pointer required">
                    Image (1920 x 500) (only accept jpg, png)
                </label>
                <input
                    type="file"
                    name="image"
                    id="image"
                    class="upload-image-copper"
                    data-uic-display-width="768"
                    data-uic-display-height="{{$config->height * 0.4}}"
                    data-uic-target-width="1920"
                    data-uic-target-height="{{$config->height}}"
                    data-uic-title="Size: 1920(w) x {{$config->height}}(h)"
                    data-uic-path="{{ $slider->getMedia('laravel_block_banner_slider_content')->first()->getUrl() }}"
                />
            </div>

            @foreach (config('translatable.locales') as $locale)
                <div class="mt-7">
                    <label for="content_{{ $locale }}" class="block mb-2 cursor-pointer">
                        Content({{ $locale }})
                    </label>
                    <textarea name="content_{{ $locale }}" class="element" style="height: 200px;">{{$slider->getTranslation("content", $locale)}}</textarea>
                </div>
            @endforeach

            <div class="mt-7">
                <label for="animation" class="block mb-2 cursor-pointer">
                    Animation
                </label>
                <select name="animation" id="animation" class="appearance-none w-full px-4 py-2 focus:outline-none">
                    <option value="">-- None --</option>
                    <option value="fade-up" @if($slider->animation == "fade-up") selected @endif>Fade In Up</option>
                </select>
            </div>

            <div class="mt-4 text-right">
                <x-backend.link href="{{ url()->previous() }}">Back</x-backend.link>
                <x-backend.button class="ml-3">Save</x-backend.button>
            </div>
        </form>
    </div>
@endsection

@push(config("gmj.backend.push_js_path"))
    <script src="https://cdn.tiny.cloud/1/oc28g760xepwuf67x0d41w72jmhs2pra79599ky264hjbjsi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '.element',
            height: 500,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste imagetools wordcount template'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code template',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
            image_title: true,
            automatic_uploads: true,
            file_picker_types: "image",
            content_css: '{{ asset("css/app.css") }}',
       /*      formats:{
                alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
                aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
                alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
                alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
                bold : {inline : 'span', 'classes' : 'bold'},
                italic : {inline : 'span', 'classes' : 'italic'},
                underline : {inline : 'span', 'classes' : 'underline', exact : true},
                strikethrough : {inline : 'del'},
                forecolor : {inline : 'span', classes : 'forecolor', styles : {color : '%value'}},
                hilitecolor : {inline : 'span', classes : 'hilitecolor', styles : {backgroundColor : '%value'}},

            }, */
            style_formats: [
                { title: 'container', selector: 'div', classes: 'container px-8 mx-auto' },
            ],
            file_picker_callback: function(callback, value, meta) {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function(){
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function(){
                        var id = "blobid_" + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(",")[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        callback(blobInfo.blobUri(), {title: file.name});
                    };
                    reader.readAsDataURL(file);
                };
                input.click();
                // imageFilePicker(callback, value, meta);
            },
            templates : [
                {
                    title: 'Banner Slider Content Center',
                    description: 'full page',
                    content: `<div class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-20 flex justify-center items-center text-white">
                        <div class="banner_slider_content_content text-center px-10">
                        <div class="lg:text-6xl font-bold md:text-4xl text-3xl">TITLE</div>
                        <div class="text-xs lg:text-lg">Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</div>
                        <div class="mt-4">
                            <a class="inline-block px-8 py-2 border rounded-full mx-2"> Link </a>
                            <a class="inline-block px-8 py-2 border rounded-full mx-2"> Link </a>
                        </div>
                        </div>
                    </div>`
                },
                {
                    title: 'Banner Slider Content Left',
                    description: 'full page',
                    content: `<div class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-20 flex items-center text-white">
                        <div class="banner_slider_content_content px-10">
                        <div class="lg:text-6xl font-bold md:text-4xl text-3xl">TITLE</div>
                        <div class="text-xs lg:text-lg">Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</div>
                        <div class="mt-4">
                            <a class="inline-block px-8 py-2 border rounded-full mx-2"> Link </a>
                            <a class="inline-block px-8 py-2 border rounded-full mx-2"> Link </a>
                        </div>
                        </div>
                    </div>`
                },
            ]
        });


        /* editor.on("keyup", function(){
            console.log("change......");
        });
        document.getElementById("save").addEventListener("click", function(){
            var content = tinymce.get("element1").getContent();
            console.log(content);
            return false;
        }); */
    </script>
@endpush

