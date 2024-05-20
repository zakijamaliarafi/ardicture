<x-app-layout>
    <div>
        <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf

            
            <div class="mb-3">
                <label for="images" class="form-label">Upload Images</label>
                <div id="image-preview-wrapper" class="mb-3">
                    <img src="" alt="" class="img-preview img-fluid mb-3 col-sm-5">
                </div>
                <input class="form-control @error('images') is-invalid @enderror" type="file" id="images" name="images[]" onchange="previewImages();" multiple>
                @error('images')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="description" class="form-label">Description</label>
                <br>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required autofocus value="{{ old('description') }}" cols="30" rows="10"></textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>  
</x-app-layout>