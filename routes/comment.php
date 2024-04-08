<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


// Handle the addition of comments or replies to a post with input sanetizations
Route::post('comment/add',function(){
    
    $comment    = htmlspecialchars(request()->input('comment'));
    $comment_id = htmlspecialchars(request()->input('comment_id'));
    $reply_to_id = htmlspecialchars(request()->input('reply_to_id'));
    $post_id    = htmlspecialchars(request()->input('post_id'));
    $user_name  = htmlspecialchars(request()->input('user_name'));
            
    // Check if user_id is in session
    $user_id = session('user_id');


    // If user_id is not in session, get user details from the input
    if (!$user_id) {

        // validate username/author name is required and must be not numeric 
        if (empty($user_name)) {
            return redirect()->back()->withInput(request()->all())->with('error', 'Your Name is required.');
        } elseif (!preg_match('/^[a-zA-Z\s]+$/', $user_name)) {
            return redirect()->back()->withInput(request()->all())->with('error', 'Your Name must not have numeric characters.');
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

    $user_name =  DB::table('users')->where('id',$user_id)->first()->name;

            // add a comment 
            DB::table('comments')->insert([
            'comment'    => $comment,
            'user_id'    => $user_id,
            'post_id'    => $post_id,
            'comment_id' => $comment_id > 0 ? $comment_id : 0,
            'reply_to_id' => $reply_to_id > 0 ? $reply_to_id : 0,
            'user_name'  => $user_name,
        ]);

        $message = $post_id > 0 ? 'Reply added success fully.' : 'Comment added successfully.';
        return redirect()->back()->with('success', $message);


});
