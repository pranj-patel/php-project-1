@extends('layout.layout')

@section('title', $_GET['author_name']) <!-- Set the page title to the author's name from the URL -->

@section('authors_status', 'active') <!-- Highlight the "Authors" link in the navigation bar -->

@section('content')
<div class="container content-width">
    <div class="heading-container">
        <h1 class="heading-title">Posts by {{ $_GET['author_name'] }}</h1> <!-- Display the author's name -->
    </div>

    <div class="content">
        {{-- Check if there are no posts available, and display an error message if so --}}
        @if(!isset($posts[0]))
        <p class="alert alert-danger">No Posts Found !</p>
        @endif 

        @include('posts_list') <!-- Include the 'posts_list' partial view to display the posts -->
    </div>
</div>
@endsection
