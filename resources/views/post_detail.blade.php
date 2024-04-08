@extends('layout.layout')  <!-- Extending the layout template -->

@section('content')  <!-- Defining the content section -->
@section('title', $post->title)  <!-- Setting the page title -->
@section('home_status', 'active')  <!-- Marking the 'Home' link as active in the navigation bar -->

@push('css')  <!-- Pushing custom CSS styles into the stack -->
<style>
      .post-container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #ffffff;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        position: relative;
    }
    
    .post-title {
        font-size: 24px;
        font-weight: bold;
        margin: 10px 0;
    }
    
    .post-author {
        font-size: 16px;
        color: #555555;
    }
    
    .post-meta {
        margin-top: 15px;
    }
    
    .post-meta i {
        margin-right: 5px;
    }
    #like_link{cursor:pointer}

    #like_form input{margin:0}

    #like_form{
        display: flex;
        align-items: flex-end;
        margin-top:20px;
        display: none;
    }

    #like_form.active{
        display: flex;
    }

    #like_form div{
        width:50%;
    }

    #like_form button{
        margin-left:10px;
    }

    .delete_btn{top:30px;right:30px;background-color: #ffffffc2;padding:4px 12px;}

    .message{
        font-size: 14px;
        color: #555555;
        line-height: 24px;
    }

</style>
@endpush

<div class="container content-width">  <!-- Container for content -->

    <div class="post-container">  <!-- Container for the post content -->

    <div class="delete_btn">
        <!-- Edit and Delete Post Links -->
        <a class="text-primary" href="{{ Asset('post/edit').'/'.$post->id }}" title="Edit Post">Edit</a>&nbsp;|
        <a class="text-danger" href="{{ Asset('post/delete').'/'.$post->id }}" title="Delete Post" onclick="return confirm('Confirm deleting post?')">Delete</a>
    </div>

    <h2 class="post-title">{{ $post->title }}</h2>  <!-- Display the post title -->
    <p class="post-author">Posted by {{ $post->user_id }}</p>  <!-- Display the post author -->

    <div class="post-meta">
        @if(session()->has('user_id'))
            <a href="{{ Asset('post/like').'/'.$post->id }}">Likes: {{ $post->like_count }}</a> |  <!-- Display the like count -->
        @else
            <a id="like_link">Likes: {{ $post->like_count }}</a> |  <!-- Display the like count with a 'Like' link -->
        
        @endif   
        Comments: {{ $post->comment_count }}  <!-- Display the comment count -->
    </div>

    <form id="like_form" action="{{ Asset('post/like').'/'.$post->id }}">  <!-- Form for liking the post -->
        <div>
        <label>Your Name <small class="text-danger">*</small></label>  <!-- Input field label -->
        <input type="text" name="user_name" placeholder="Please enter your name to like the post">  <!-- Input field for the user's name -->
    </div>
        <div>
            <button type="submit">OK</button>  <!-- Submit button for liking the post -->
        </div>
    </form>

    <hr class="line-break">  <!-- Horizontal line as a visual separator -->

    <p class="message">{{ $post->message }}</p> <!-- Display the post message-->

    @include('comments')  <!-- Include the comments section -->

    </div>

</div>

@endsection  <!-- End of the content section -->
