<x-app-layout>
<div class="container">
    <h1>Edit Post</h1>
    <form method="post" action="{{ route('posts.update', $post->post_id) }}">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $post->description }}</textarea>
        </div>
        
        <div class="mb-3">
            <label for="likes_count" class="form-label">Likes Count</label>
            <input type="number" class="form-control" id="likes_count" name="likes_count" value="{{ $post->likes_count }}">
        </div>
        
        <div class="mb-3">
            <label for="rate" class="form-label">Rate</label>
            <input type="number" class="form-control" id="rate" name="rate" value="{{ $post->rate }}">
        </div>
        
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
<x-app-layout>
