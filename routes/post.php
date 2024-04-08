<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/******
 * This code is used to create new posts. It validates input fields with HTML and SQL sanitization.
 * It gets data from form requests and creates the post while taking care of the following logic.
 *******/


/******

** Security Checks Implemented while adding/updating a post 
* Sanitization: User input fields are sanitized using htmlspecialchars to prevent HTML and script injection. This helps mitigate the risk of cross-site scripting (XSS) attacks.
* Input Validation: Input fields are validated to ensure they meet specific criteria. The title, and message are validated to prevent empty or malicious data from being processed.
* Database Interaction Security: Data inserted into the database is carefully handled using Laravel's query builder. Sanitized data is used to prevent SQL injection.

 *******/

Route::post('post/create',function(){

    //   Sanitize input fields
      $title      = htmlspecialchars(request()->input('title'));
      $message    = htmlspecialchars(request()->input('message'));
      $user_name  = htmlspecialchars(request()->input('user_name'));


      // Validate title
      if (empty($title)) {
          return redirect()->back()->withInput()->with('error', 'Title is required.');
      }elseif(strlen($title) < 3)
      {
          return redirect()->back()->withInput()->with('error', 'Title must be at least 3 characters long.');
      }


      // Validate message
      if (empty($message)) {
          return redirect()->back()->withInput()->with('error', 'Message is required.');
      }elseif (str_word_count($message) < 5) {
          return redirect()->back()->withInput(request()->all())->with('error', 'Message must have at least 5 words.');
      }
      
      // Check if user_id is in session
      $user_id = session('user_id');


      // If user_id is not in session, get user details from the input
      if (!$user_id) {

          // validate username/author name is required and must be not numeric 
          if (empty($user_name)) {
              return redirect()->back()->withInput(request()->all())->with('error', 'Author is required.');
          } elseif (!preg_match('/^[a-zA-Z\s]+$/', $user_name)) {
              return redirect()->back()->withInput(request()->all())->with('error', 'Author name must not have numeric characters.');
          }

          // find user by its name from table if exists then use their id
          $chkUser = DB::table('users')->where('name',$user_name)->first();

          if($chkUser)
          {
              $user_id = $chkUser->id; 
          }else{
              // Create a new user and retrieve the user_id
              $user_id = DB::table('users')->insertGetId([
                  'name' => $user_name,
              ]);
          }

          // Save the user_id in the session
          session(['user_id' => $user_id]);
      }


      // Create the post
      $post_id = DB::table('posts')->insertGetId([
          'title'   => $title,
          'message' => $message,
          'user_id' => $user_id,
      ]);

      // Redirect to home or show success message
      return redirect('/')->with('success', 'Post Added');

});

/******
* Get id from request and show the edit form with post data.
 *******/

Route::get('post/edit/{id}',function($id){
    $post = DB::table('posts')->find($id);
    return view('post_edit',['post'=>$post]);
});




/******
 * Updates an existing post with sanitized title and message.
 * Validates inputs and redirects with success or error messages.
 *******/

Route::post('post/update',function(){

    // Sanitize input fields
    $post_id    = htmlspecialchars(request()->input('post_id'));
    $title      = htmlspecialchars(request()->input('title'));
    $message    = htmlspecialchars(request()->input('message'));


    // Validate title
    if (empty($title)) {
        return redirect()->back()->withInput()->with('error', 'Title is required.');
    }elseif(strlen($title) < 3)
    {
        return redirect()->back()->withInput()->with('error', 'Title must be at least 3 characters long.');
    }

    // Validate message
    if (empty($message)) {
        return redirect()->back()->withInput()->with('error', 'Message is required.');
    }elseif (str_word_count($message) < 5) {
        return redirect()->back()->withInput(request()->all())->with('error', 'Message must have at least 5 words.');
    }

    // Update the post
    DB::table('posts')->where('id', $post_id)->update([
        'title' => $title,
        'message' => $message,
    ]);

    // Redirect to post detail page
    return redirect('post/' . $post_id)->with('success', 'Post Updated');
});



/******
* This route handles the retrieval and presentation of detailed information about a specific post.
* The code fetches the post's data from the "posts" table based on the provided {id} parameter.
* If the post doesn't exist, a 404 error is generated.
*
* The code then proceeds to calculate and append the like count and comment count for the post.
* It also fetches the top-level comments related to the post and enhances them with a human-readable
* time span and any associated replies, including the user being replied to.
*
* Each reply is further enriched with a time span and the name of the user being replied to.
*
* Finally, the code assembles all the enhanced data and passes it to the "post_detail" view for rendering.
*******/

Route::get('post/{id}', function ($id) {
   // Retrieve the post data from the "posts" table
   $post = DB::table('posts')->where('id', $id)->first();
   
   // If the post doesn't exist, generate a 404 error
   if (!$post) {
       abort(404);
   }

   // Calculate and append the likes count for the current post
   $post->like_count = DB::table('likes')->where('post_id', $id)->count();

   // Calculate and append the comment count for the current post
   $post->comment_count = DB::table('comments')->where('post_id', $id)->count();

   // Fetch top-level comments related to the post and enhance them with details
   $comments = DB::table('comments')->where(['post_id'=>$id,'comment_id'=>0])->orderBy('id','ASC')->get();
   foreach($comments as $key => $comment) {
       // Add a human-readable time span to the comment
       $comment->time_span = Carbon::parse($comment->created_at)->diffForHumans();

       // Fetch replies for the current comment
       $replies = DB::table('comments')->where('comment_id',$comment->id)->latest('id')->get();

       // Enhance each reply with a time span and the replied-to user's name
       foreach ($replies as $reply) {
           $reply->time_span = Carbon::parse($reply->created_at)->diffForHumans();
           if ($reply->reply_to_id > 0) {
               $user_id = DB::table('comments')->where('id', $reply->reply_to_id)->first()->user_id;
           } else {
               $user_id = DB::table('comments')->find($reply->comment_id)->user_id;
           }
           $user = DB::table('users')->find($user_id);
           $reply->reply_to = $user ? $user->name : '';
       }
       $comment->replies = $replies;
   }

   // Attach the enhanced comments to the post data
   $post->comments = $comments;

   // Pass the enriched post data to the "post_detail" view
   return view('post_detail', ['post' => $post]);
});



/******
* Route to delete a post and its associated comments and likes from the database. 
* After deletion, user is redirected back with a success message.
*******/
Route::get('post/delete/{id}',function($id){

    DB::table('posts')->where('id', $id)->delete();
    DB::table('comments')->where('post_id', $id)->delete();
    DB::table('likes')->where('post_id', $id)->delete();

    return redirect('/')->with('success','Post Deleted.');
});