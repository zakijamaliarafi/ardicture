<x-layout>
    <div>
        <form method="post" action="/posts/store" enctype="multipart/form-data" id="post-form" x-data="formHandler()">
            @csrf
            
            <div>
                <label for="images">Upload Images</label>
                <div>
                    <img src="" alt="">
                </div>
                <input type="file" id="images" name="images[]" multiple>
                @error('images')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div>
                <label for="description">Description</label>
                <br>
                <textarea id="description" name="description" required autofocus cols="30" rows="10">{{ old('description') }}</textarea>
                @error('description')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tag input section -->
            <div>
                <label for="tag">Tags</label>
                <div class="flex gap-2 mb-2">
                    <input type="text" id="tag" x-model="tag" @keydown.enter.prevent="addTagAndFocus" placeholder="Enter a tag">
                    <button type="button" @click="addTagAndFocus">Add Tag</button>
                </div>
                <template x-for="(tag, index) in tags" :key="index">
                    <div class="inline-flex items-center bg-gray-200 rounded p-1 mr-2 mb-2">
                        <p x-text="tag" class="mr-2"></p>
                        <button type="button" @click="removeTag(index)" class="text-red-600 hover:text-red-800 focus:outline-none">
                            x
                        </button>
                    </div>
                </template>                               
                <input type="hidden" name="tags" :value="tags.join(',')">
            </div>

            <button type="submit">Submit</button>
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
        });
    </script>
</x-layout>