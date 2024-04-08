@extends('layout.layout')   <!-- Extends the layout layout.blade.php -->

@section('home_status', 'active')  <!-- Sets the 'home_status' section as 'active' for highlighting in the navigation bar -->

@section('content')
    <!-- Main Content Section -->

    <div class="container content-width">
        @include('post_create_form') <!-- Include a Blade partial for creating a new post -->

        <div class="heading-container">
            <h1 class="heading-title">Explore Recent Posts</h1> <!-- Heading for the list of recent posts -->
        </div>
        <div class="content">
            
            {{-- Check if there are no posts available, then show a message --}}
            @if(!isset($posts[0]))
                <p class="alert alert-danger">No Posts Found !</p>
            @endif

            @include('posts_list') <!-- Include a Blade partial for listing the posts -->

        </div>
    </div>

    <!-- End of Main Content Section -->
    
@endsection
