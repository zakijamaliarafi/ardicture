<x-layout>
    <div class="ml-10 mt-5">
        <form method="post" action="/posts/store" enctype="multipart/form-data" id="post-form" x-data="formHandler()">
            @csrf

            <div class="w-1/2">
                <label for="images" class="font-bold text-3xl">Upload Images</label>
                <div>
                    <img src="" alt="">
                </div>
                <label for="images">

                    <div x-data="preview_handler()"
                        class="border-2 rounded-md border-orange-400 border-dashed  h-60 content-center mt-2">
                        <img src="" alt="" id="preview_image">
                        <img src="{{ asset('images/Circle-Add.png') }}" alt="Sidebar Action" id="circle_add"
                            class="h-10 mx-auto">
                        <p class="text-center font-bold mt-1" id="text_add">Choose your images</p>
                    </div>

                    <input type="file" id="images" name="images[]" hidden multiple>
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
                <label for="description" class="font-bold text-3xl">Description</label>
                <br>
                <textarea id="description" name="description" required autofocus cols="30" rows="10"
                    placeholder="Description...."
                    class="block w-5/12 h-20 mt-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('description') }}</textarea>
                @error('description')
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
                init() {
                    document.getElementById('images').addEventListener('change', this.previewImages);
                },
                preview_images(event) {
                    const files = event.target.files;
                    if (files.length > 0) {
                        const first_image = files[0];
                        const preview_image = document.getElementById('preview_image');
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            preview_image.src = e.target.result;
                        }

                        reader.readAsDataURL(first_image);
                    }
                }
            }));

        });
    </script>
</x-layout>
