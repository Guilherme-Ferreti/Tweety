<x-app>

    <div style="display:flex;justify-content:space-between" class="mb-3 p-4">
        <p style="font-size:25px"><b>Your Notifications</b></p>
        <select name="filter" style="color:black" id="filter">
            <option disabled selected>Filter by</option>
            <option value="new">New</option>
            <option value="seen">Seen</option>
        </select>
    </div>

    <div class="border border-gray-300 rounded-lg mb-5">
        

        @forelse ($notifications as $notification)

        <div class="flex p-4 {{ $loop->last ? '' : 'border-b border-b-gray-400' }}" style="width:100%; aling-items:center; flex-direction:column">

            <p class="mb-5">{{ $notification->message }}</p>

            <div style="display:flex; justify-content:space-between">
                <p class="text-sm">Sent at: {{ $notification->created_at->diffForHumans() }}</p>

                @if ($notification->seen_at != null)
                <p class="text-sm">Visualized {{ $notification->seen_at->diffForHumans() }}</p>
                @endif
            </div>

        </div>
        @empty
            <p class="p-4">All clear! Not a single notification to show...</p>
        @endforelse
    </div>

    <script>
        document.getElementById('filter').addEventListener('change', (e) => {
            window.location.href = '/notifications?filter=' + e.target.value;
        });
    </script>

</x-app>