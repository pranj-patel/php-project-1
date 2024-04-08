@foreach($posts as $post)
<div class="post">
    <div class="post_content">
        <div class="delete_btn">
            <!-- Edit and Delete Post Links -->
            <a class="text-primary" href="{{ Asset('post/edit').'/'.$post->id }}" title="Edit Post">Edit</a>&nbsp;|
            <a class="text-danger" href="{{ Asset('post/delete').'/'.$post->id }}" title="Delete Post" onclick="return confirm('Confirm deleting post?')">Delete</a>
        </div>
        <div>
            <h2 class="post-title"><a href="{{ Asset('post').'/'.$post->id }}">{{ $post->title }}</a></h2> <!-- Display the post title with a link -->
            <div class="post_meta">
                <!-- Display the post's timestamp in a human-readable format using the date function -->
                <small>{{ date('d-M-Y h:i a', strtotime($post->updated_at)) }}</small>
                <!-- Display the username of the post author -->
                <small>Posted by <b>{{ $post->user_name }}</b></small>
            </div>
        </div>
        <p class="like_comment">
            <!-- Display the number of likes and comments for the post -->
            <small>{{ $post->like_count }} Likes</small>&nbsp;|&nbsp;
            <small>{{ $post->comment_count }} Comments</small>
        </p>
    </div>
</div>
@endforeach
