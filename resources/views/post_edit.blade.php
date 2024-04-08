@extends('layout.layout') <!-- Extending the layout for this view -->
@section('home_status', 'active') <!-- Setting the 'home_status' section to 'active' -->
@section('title','Edit Post') <!-- Setting the title section to 'Edit Post' -->
@section('content') <!-- Starting the content section -->

@push('css') <!-- Pushing CSS styles for this view (none in this case) -->

@endpush

<div class="container content-width">
    <div class="post-create">
        <h2>Edit Post</h2> <!-- Displaying the 'Edit Post' heading -->
       
        <div id="createPostForm">   
            <form method="POST" action="{{ Asset('post/update') }}" enctype="multipart/form-data">
                @csrf <!-- Generating a CSRF token for security -->
                <input type="hidden" name="post_id" value="{{ $post->id }}"> <!-- Hidden input to store the post ID -->
                
                <!-- Input field for the post title with a default value -->
                <label for="title">Title: <small class="text-danger">*</small></label>
                <input type="text" id="title" value="{{ old('title') ?? $post->title }}" name="title" placeholder="Minimum 3 characters"><br>

                <br>

                <!-- Textarea for the post message with a default value -->
                <label for="editor">Message: <small class="text-danger">*</small></label>
                <textarea id="editor" name="message" rows="4" placeholder="Minimum 5 words">{!! html_entity_decode(old('message') ?? $post->message) !!}</textarea><br>

                <button type="submit">Update Post</button> <!-- Submit button to update the post -->
            </form>
        </div>
    </div>
</div>

@endsection <!-- Ending the content section -->
