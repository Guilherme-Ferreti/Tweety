<div class="border border-gray-300 rounded-lg mb-5">

    @forelse ($tweets as $tweet)
    
        @include ('tweet')
        
    @empty
        <p class="p-4">Not tweets yet!</p>
    @endforelse

</div>

{{ $tweets->links() }}