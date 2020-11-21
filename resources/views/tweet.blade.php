<div class="flex p-4 {{ $loop->last ? '' : 'border-b border-b-gray-400' }} ">

    <div class="mr-2 flex-shrink-0">
        <a href="{{ $tweet->user->path() }}">
            <img src="{{ $tweet->user->avatar }}" alt="" class="rounded-full mr-2" width="50" height="50"/>
        </a>
    </div>

    <div style="width:100%"> 
        <a href="{{ $tweet->user->path() }}">
            <h5 class="font-bold mb-4">{{ $tweet->user->username }}</h5>
        </a>
        
        <p class="text-sm mb-5">
            {{ $tweet->body }}
        </p>

        @if ($tweet->image != null)
        <div style="display:flex;justify-content:center">
            <img src="{{ $tweet->image }}" alt="" class="mb-4" style="border-radius:5px;max-height:290px"/>
        </div>
        @endif

        <div style="display:flex;justify-content:space-between; ">

            <x-like-buttons :tweet="$tweet"/>
            
            <p class="text-sm text-gray-600">Posted {{$tweet->created_at->diffForHumans()}}</p>
        </div>

    </div>

</div>