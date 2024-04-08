<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



// // Like a post 
Route::get('post/like/{id}',function($id){

        // Check if user_id is in session
        $user_id = session('user_id');
        
        
        // If user_id is not in session, get user details from the input
        if (!$user_id) {
            
                $user_name  = htmlspecialchars($_GET['user_name']);
                 // validate username/author name is required and must be not numeric 
                 if (empty($user_name)) {
                     return redirect()->back()->with('error', 'Your name is required.');
                 } elseif (!preg_match('/^[a-zA-Z\s]+$/', $user_name)) {
                     return redirect()->back()->with('error', 'Your name must not have numeric characters.');
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


             $chk_like = DB::table('likes')->where('post_id',$id)->where('user_id',$user_id)->first();

             if(!$chk_like)
             {
                DB::table('likes')->insert([
                    'post_id' => $id,
                    'user_id' => $user_id
                ]);

                return redirect()->back()->with('success','Post Liked.');
            }else{
                return redirect()->back()->with('error','You cannot like a post twise.');
             }



});
