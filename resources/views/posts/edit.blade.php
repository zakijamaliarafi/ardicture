<x-layout>
<div class="container">
    <h1>Edit Post</h1>
    <form method="post" action="/posts/{{$post->id}}">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $post->description }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
</x-layout>
