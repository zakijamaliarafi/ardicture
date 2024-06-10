<x-layout>
    <div class="ml-10 mt-5">
        <form method="post" action="/posts/store" enctype="multipart/form-data" id="post-form" x-data="formHandler()">
            @csrf

            <div class="w-1/2">
                <label for="images">
                    <div x-data="preview_handler()" id="image_container"
                        class="relative border-2 rounded-md border-orange-400 border-dashed h-60 content-center mt-2">
                        <template x-for="(image, index) in images" :key="index">
                            <div x-show="active_slides === index + 1" class="w-full justify-center content-center"
                                id="preview_image">
                                <img :src="image" alt="Preview Image" class="h-full mx-auto">
                            </div>

                        </template>
                        <div class="absolute inset-0 flex items-center justify-between z-50" x-show="images.length > 1"
                            id="arrow_container">
                            <div class="flex items-center justify-start w-1/2">
                                <button type="button"
                                    class="text-black bg-orange-500 hover:text-orange-500 font-bold hover:shadow-lg rounded-full w-12 h-12"
                                    x-on:click="active_slides = active_slides === 1 ? images.length : active_slides - 1">
                                    &#8592;
                                </button>
                            </div>
                            <div class="flex items-center justify-end w-1/2">
                                <button type="button"
                                    class="text-black bg-orange-500 hover:text-orange-500 font-bold hover:shadow rounded-full w-12 h-12"
                                    x-on:click="active_slides = active_slides === images.length ? 1 : active_slides + 1">
                                    &#8594;
                                </button>
                            </div>
                        </div>


                        <div id="preview_placeholder">
                            <img src="{{ asset('images/Circle-Add.png') }}" alt="Sidebar Action" id="circle_add"
                                class="h-10 mx-auto">
                            <p class="text-center font-bold mt-1" id="text_add">Choose your images</p>
                        </div>

                        <input type="file" id="images" name="images[]" hidden multiple @change="preview_images">
                    </div>

                </label>
                <div class="flex justify-between">
                    <p class="text-slate-400">Supported formats : JPG, PNG</p>
                    <p class="text-slate-400">Multiple images possible</p>
                </div>
                @error('images')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mt-6">
                <label for="title" class="font-bold text-3xl">Title</label>
                <br>
                <textarea id="Title" name="title" required autofocus cols="30" rows="10" placeholder="title...."
                    class="block w-5/12 h-20 mt-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('title') }}</textarea>
                @error('title')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tag input section -->
            <div class="mt-3">
                <label for="tag" class="font-bold text-3xl">Tags</label>
                <div class="flex gap-2 mt-3 mb-2 content-center">
                    <input
                        class="block w-5/12 h-10 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        type="text" id="tag" x-model="tag" @keydown.enter.prevent="addTagAndFocus"
                        placeholder="Enter a tag">
                    <button type="button" @click="addTagAndFocus" class="bg-black px-4 rounded-xl h-10">
                        <p class="align-middle text-white">Add Tag</p>
                    </button>
                </div>
                <template x-for="(tag, index) in tags" :key="index">
                    <div class="inline-flex items-center bg-gray-200 rounded p-1 mr-2 mb-2">
                        <p x-text="tag" class="mr-2"></p>
                        <button type="button" @click="removeTag(index)"
                            class="text-red-600 hover:text-red-800 focus:outline-none">
                            x
                        </button>
                    </div>
                </template>
                <input type="hidden" name="tags" :value="tags.join(',')">
            </div>

            <div class="flex h-10 w-5/12 mt-6 justify-between">
                <div class="w-1/2"></div>
                <div class="w-1/2 flex justify-between">
                    <button type="reset"
                        class="bg-white w-32 rounded-md text-lg border-2 border-orange-500 ">Cancel</button>
                    <button type="submit" class="bg-orange-500 w-32 rounded-md text-white text-lg">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <x-footer />
    <script>
        document.addEventListener('alpine:init', () => {
            console.log('Alpine.js initialized');

            Alpine.data('formHandler', () => ({
                tag: '',
                tags: [],
                init() {
                    console.log('formHandler component initialized');
                },
                addTag() {
                    if (this.tag.trim() !== '') {
                        let formattedTag = this.tag.trim().toLowerCase().replace(/ /g, '_');
                        formattedTag = formattedTag.charAt(0).toUpperCase() + formattedTag.slice(1);
                        console.log('Adding tag:', formattedTag);
                        this.tags.push(formattedTag);
                        this.tag = '';
                    } else {
                        console.log('Tag is empty, not adding');
                    }
                },
                addTagAndFocus(event) {
                    this.addTag();
                    this.$nextTick(() => {
                        document.getElementById('tag').focus();
                    });
                },
                removeTag(index) {
                    this.tags.splice(index, 1);
                }
            }));


            Alpine.data('preview_handler', () => ({
                images: [],
                active_slides: 1,
                init() {
                    console.log('preview_handler initialized');
                },
                preview_images(event) {
                    this.images = [];
                    const files = event.target.files;
                    if (files) {
                        for (let i = 0; i < files.length; i++) {
                            let reader = new FileReader();
                            reader.onload = (e) => {
                                this.images.push(e.target.result);
                                if (files.length > 1) {

                                }
                            }
                            reader.readAsDataURL(files[i]);
                        }
                        document.getElementById('preview_placeholder').style.display = 'none';
                        document.getElementById('image_container').classList.add('flex');
                        document.getElementById('preview_image').classList.add('h-full');
                        this.image.style.display = 'flex'
                    }
                }
            }));

        });
    </script>
</x-layout>
