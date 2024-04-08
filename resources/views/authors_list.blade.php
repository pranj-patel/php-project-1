@extends('layout.layout') <!-- Extending the layout template -->

@section('content')
@section('title', 'All Authors') <!-- Setting the page title -->

@section('authors_status', 'active') <!-- Highlighting the "Authors" link in the navigation bar -->

@push('css')
<!-- Add any additional CSS styles or links here -->
<style>
    .content-width {
        max-width: 800px;
        margin: 0 auto;
    }

    .heading-container {
        text-align: center;
        margin-bottom: 30px;
    }

    .heading-title {
        font-size: 28px;
        color: #333;
    }

    .author-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .author-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #ccc;
    }

    .author-name {
        font-size: 18px;
        color: #444;
    }

    .post-count {
        font-size: 16px;
        color: #666;
        background-color: #f3f3f3;
        padding: 5px 10px;
        border-radius: 5px;
    }
</style>
@endpush

<div class="container content-width">
    <div class="heading-container">
        <h3 class="heading-title">All Authors List</h3> <!-- Displaying the heading -->
    </div>

    <ul class="author-list">
        @foreach($authors as $author)
        <li class="author-item">
            <a href="{{ Asset('author-posts?author_id=').$author->id.'&author_name='.$author->name }}" class="author-name"><b>{{ $author->name }}</b></a> <!-- Displaying the author's name and linking to their posts -->
            <span class="post-count">{{ $author->post_count }} Posts</span> <!-- Displaying the number of posts by the author -->
        </li>
        @endforeach
    </ul>
</div>
@endsection
