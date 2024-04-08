<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/****
 * This route retrieves posts from the "posts" table along with user information,
 * orders them in chronological order based on creation date, and calculates the
 * like and comment counts for each post. The resulting posts are passed to the "home"
 * view for rendering on the home page.
 ****/

Route::get('/',function(){

    // Retrieve posts from the "posts" table in chronological order
    $posts = DB::table('posts')->join('users', 'posts.user_id', '=', 'users.id')->latest('posts.created_at')
    ->select('posts.*', 'users.name as user_name', 'users.slug as user_slug')
    ->get();

        // Iterate through each post to add like and comment counts to post
        foreach ($posts as $post) {
        $post->like_count = DB::table('likes')->where('post_id', $post->id)->count();
        $post->comment_count = DB::table('comments')->where('post_id', $post->id)->count();
    }

    // Return the posts to the "home" view
    return view('home', ['posts' => $posts]);

});



/*****
 * Retrieves a list of authors with their user IDs and post counts.
 * Fetches user information from users table and calculates post count
 * for each author and displays the list in the authors list page.
 *****/

Route::get('authors',function(){
    $users = DB::table('users')->distinct('name')->select('id','name')->get();
    foreach($users as $user)
    {
        $user->post_count = DB::table('posts')->where('user_id',$user->id)->count();
    }

    return view('authors_list',['authors'=>$users]);
 });



 /*****
  * Retrieves posts written by a specific author from the "posts" table.
  * add like and comment counts to posts and displays them in the "author_posts" view.
  *****/

Route::get('author-posts',function(){
    // Retrieve posts from the "posts" table in chronological order
    $posts = DB::table('posts')->where('user_id',$_GET['author_id'])->join('users', 'posts.user_id', '=', 'users.id')->latest('posts.created_at')
    ->select('posts.*', 'users.name as user_name', 'users.slug as user_slug')
    ->get();

    // Iterate through each post to add like and comment counts to post
    foreach ($posts as $post) {
        $post->like_count = DB::table('likes')->where('post_id', $post->id)->count();
        $post->comment_count = DB::table('comments')->where('post_id', $post->id)->count();
    }

    return view('author_posts', ['posts' => $posts]);
 });