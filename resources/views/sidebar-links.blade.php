<ul>
    <li> 
        <a class="font-bold text-lg mb-4 block" href="{{ route('home') }}">Home</a>
    </li>

    <li> 
        <a class="font-bold text-lg mb-4 block" href="/explore">Explore</a>
    </li>

    <li> 
        <a class="font-bold text-lg mb-4 block" href="{{ route('profile', auth()->user()) }}">Profile</a>
    </li>

    <li> 
        <a class="font-bold text-lg mb-4 block" href="{{ route('mentions') }}">Mentions</a>
    </li>

    <li> 
        <a class="font-bold text-lg mb-4 block" href="{{ route('notifications.index') }}">Notifications</a>
    </li>

    <li> 
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="font-bold text-lg block">Logout</button>
        </form>
    </li>

</ul>
