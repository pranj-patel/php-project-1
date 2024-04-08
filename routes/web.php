<?php

use Illuminate\Support\Facades\Route;

// handle homepage and author page 
include('main.php');

// handle posts related actions 
include('post.php');

// handle comments and replies
include('comment.php');

// handle likes to post
include('like.php');



// logout 
Route::get('logout',function(){
    session()->forget('user_id');
    return redirect()->back();
});