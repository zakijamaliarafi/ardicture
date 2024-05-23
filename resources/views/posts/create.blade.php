<x-app-layout>
    <div>
        <form method="post" action="/posts/store" enctype="multipart/form-data">
            @csrf

            
            <div class="mb-3">
                <label class="form-label" for="images">Upload Images</label>
                <div class="mb-3" id="image-preview-wrapper">
                    <img class="img-preview img-fluid mb-3 col-sm-5" src="" alt="">
                </div>
                <input class="form-control @error('images') is-invalid @enderror" type="file" id="images" name="images[]" onchange="previewImages();" multiple>
                @error('images')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label class="form-label" for="description">Description</label>
                <br>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required autofocus value="{{ old('description') }}" cols="30" rows="10"></textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>  
</x-app-layout>