<div class="post-create">
    <h2>Create a New Post</h2> <!-- Displaying the 'Create a New Post' heading -->

    <div id="createPostForm">   
        <form method="POST" action="{{ Asset('post/create') }}" enctype="multipart/form-data">
            @csrf <!-- Generating a CSRF token for security -->

            <!-- Input field for the post title with a default value -->
            <label for="title">Title: <small class="text-danger">*</small></label>
            <input type="text" id="title" value="{{ old('title') }}" name="title" placeholder="Minimum 3 characters"><br>

            <!-- Checking if the user is not logged in, and displaying the author name input field -->
            @if(!session()->has('user_id'))
            <label for="user_name">Author: <small class="text-danger">*</small></label>
            <input type="text" id="user_name" value="{{ old('user_name') }}" name="user_name" placeholder="Author name"><br>
            @endif

            <!-- Textarea for the post message with a default value -->
            <label for="editor">Message: <small class="text-danger">*</small></label>
            <textarea id="editor" name="message" rows="4" placeholder="Minimum 5 words">{{ old('message') }}</textarea><br>

            <button type="submit">Create Post</button> <!-- Submit button to create the post -->
        </form>
    </div>
</div>

