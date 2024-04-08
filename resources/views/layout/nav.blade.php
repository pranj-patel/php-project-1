<nav class="header">
    <div class="nav-container">
        <div class="logo">
            <a href="{{ Asset('/') }}"><img src="{{ Asset('images/logo.png') }}" alt="logo"></a>
        </div>

        @php
             $user_id = session('user_id');
             $user = \DB::table('users')->find($user_id);
        @endphp

        @if ($user)
        <div class="user_name">Welcome <b class="primary">{{ $user->name }}</b></div>
        @endif
      
        <div class="nav-links">
            <a href="{{ Asset('/') }}" class="@yield('home_status')">Home</a>
            <a href="{{ Asset('authors') }}" class="@yield('authors_status')">All Authors</a>
            <a href="{{ Asset('logout') }}">Logout</a>
        </div>
    </div>
</nav>
