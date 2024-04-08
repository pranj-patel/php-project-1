<!-- Reply button for replying to a comment -->
<p class="reply_button" onclick="toggleCollapse('reply_form_{{ isset($reply) ? $reply->id : $comment->id }}')">
    <span class="primary">Reply to this comment</span>
</p>

<!-- Reply form for adding a reply to a comment -->
<form action="{{ Asset('comment/add') }}" method="POST" id="reply_form_{{ isset($reply) ? $reply->id : $comment->id }}" class="reply_form">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
    <input type="hidden" name="reply_to_id" value="{{ isset($reply->id) ? $reply->id : 0 }}">

    <!-- Input field for the user's name (if not logged in) -->
    @if(!session()->has('user_id'))
    <label for="user_name">Your Name: <small class="text-danger">*</small></label>
    <input type="text" id="user_name" name="user_name">
    @endif

    <!-- Input field for the reply comment -->
    <label for="comment">Comment: <small class="text-danger">*</small></label>
    <textarea id="comment" name="comment" rows="4"></textarea>
    <br>

    <!-- Submit button for saving the reply -->
    <button type="submit">Save</button>
</form>

<!-- JavaScript function to toggle the form's visibility -->
<script>
    function toggleCollapse(formId) {
        const replyForm = document.getElementById(formId);
        if (replyForm.style.display === 'none' || replyForm.style.display === '') {
            replyForm.style.display = 'block';
        } else {
            replyForm.style.display = 'none';
        }
    }
</script>
