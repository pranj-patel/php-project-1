@push('css')
<style>
    /* Styles for the comments section */
    .post-comments {
        margin-top: 20px;
    }

    /* Styles for a single comment */
    .comment {
        position: relative;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    /* Styles for nested replies */
    .replies .comment {
        border: 1px solid #ccc;
        margin-bottom: 5px;
    }

    /* Styles for the comment header */
    .comment-header {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }

    /* Styles for the username */
    .username {
        font-weight: bold;
        margin-right: 5px;
    }

    /* Styles for the comment date */
    .comment-date {
        color: #888;
    }

    /* Styles for the comment content */
    .comment-content {
        font-size: 14px;
        margin-bottom: 10px;
    }

    /* Styles for the "View Replies" button */
    .view-replies-button {
        background-color: #fff;
        color: var(--primary);
        border: none;
        margin-bottom: 10px;
        position: relative;
        margin-left: 30px;
        color: #797979;
        font-size: 12px;
    }

    /* Styles for nested replies container */
    .replies {
        margin-left: 30px;
    }

    /* Styles for username and comment date */
    .username, .comment-date {
        font-size: 12px;
    }

    /* Styles for comment content within replies */
    .replies .comment-content {
        font-size: 13px;
    }

    /* Styles for the line break */
    .line-break {
        margin-top: 20px;
    }

    /* Styles for the "View Replies" button icon */
    .view-replies-button::before {
        position: absolute;
        content: '';
        left: -26px;
        border-top: 1px solid #797979;
        width: 20px;
        top: 7px;
    }

    /* Styles for the comment delete button */
    .comment-delete {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 12px;
    }

    /* Styles for the comment form container */
    .comment-form {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Styles for the comment form header */
    .comment-form h3 {
        font-size: 18px;
        margin: 0px;
    }

    /* Styles for the comment form toggle button */
    .comment-form .btn-toggle {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        outline: none;
    }

    /* Styles for the comment form toggle button icon */
    .comment-form .btn-toggle i {
        font-size: 18px;
    }

    /* Styles for comment form labels */
    .comment-form label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    /* Styles for comment form input fields and textarea */
    .comment-form input[type="text"],
    .comment-form textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    /* Styles for textarea resize */
    .comment-form textarea {
        resize: vertical;
    }

    /* Styles for the comment form toggle button */
    .comment-form-toggle {
        cursor: pointer;
    }

    /* Styles for the reply button */
    .reply_button {
        font-size: 12px;
        cursor: pointer;
    }

    /* Styles for the reply form */
    .reply_form {
        display: none;
        margin-left: 10px;
        margin-bottom: 20px;
    }

    /* Styles for the active reply form */
    .reply_form.active {
        display: block;
    }
</style>
@endpush

<!-- Horizontal line as a visual separator -->
<hr class="line-break">

{{-- Comment form starts here --}}
<div class="comment-form">
    <h3 class="comment-form-toggle">
        <button class="btn-toggle" aria-expanded="false"></button>
        Add a Comment
    </h3>
    <div class="comment-form-content">
        <form method="post" action="{{ Asset('comment/add') }}">
            @csrf
            <br>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            @if(!session()->has('user_id'))
            <label for="author">Your Name: <small class="text-danger">*</small></label>
            <input type="text" id="author" name="user_name">
            @endif
            <label for="comment">Comment: <small class="text-danger">*</small></label>
            <textarea id="comment" name="comment" rows="4"></textarea>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>
{{-- Comment form ends here --}}

<div class="post-comments">
    @foreach ($post->comments as $comment)
    <div class="comment">
        <div class="comment-header">
            <span class="username">{{ $comment->user_name }}</span>
            <span class="comment-date">{{ $comment->time_span }}</span>
        </div>
        <div class="comment-content">
            {{ $comment->comment }}
        </div>
        @include('comment_reply')
        @php
            $reply_count = count($comment->replies);
        @endphp
        @if ($reply_count > 0)
        <button class="view-replies-button">Replies ({{ $reply_count }})</button>
        @endif
        <!-- Nested Replies -->
        <div class="replies">
            @foreach ($comment->replies as $reply)
            <!-- Nested Comment-->
            <div class="comment">
                <div class="comment-header">
                    <span class="username">{{ $reply->user_name }}</span>
                    <span class="comment-date">{{ $reply->time_span }}</span>
                </div>
                <div class="comment-content">
                    <b><span>@</span>{{ $reply->reply_to }}</b> {{ $reply->comment }}
                </div>
                @include('comment_reply')
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>

@push('js')
<script>
    // JavaScript function to toggle the display of reply forms
    function toggleCollapse(div_id)
    {
        const content = document.querySelector("#"+div_id);
        content.classList.toggle("active");
    }
</script>
@endpush
