<x-app-layout>
<div class="p-6 text-white">

    <h2 class="text-2xl font-bold mb-6">📥 Incoming Requests</h2>

    @if(session('success'))
        <div class="mb-4 text-green-400">{{ session('success') }}</div>
    @endif

    @forelse($requests as $r)

    <div class="bg-white/5 p-4 rounded-xl border border-white/10 mb-4">

        <!-- USER INFO -->
        <h3 class="text-lg font-semibold mb-1">
            {{ $r->sender->name }}
        </h3>

        <!-- DETAILS -->
        <p class="text-sm text-gray-300 mb-2">
            Wants to learn: <span class="text-blue-400">{{ $r->skill_requested }}</span>
        </p>

        <p class="text-sm text-gray-300 mb-2">
            Offers: <span class="text-green-400">{{ $r->skill_offered }}</span>
        </p>

        <!-- STATUS -->
        <p class="mb-3">
            Status:
            <span class="
                {{ $r->status == 'pending' ? 'text-yellow-400' : '' }}
                {{ $r->status == 'accepted' ? 'text-green-400' : '' }}
                {{ $r->status == 'rejected' ? 'text-red-400' : '' }}
                {{ $r->status == 'completed' ? 'text-purple-400' : '' }}
            ">
                {{ ucfirst($r->status) }}
            </span>
        </p>

        <!-- ACTION BUTTONS -->
        @if($r->status == 'pending')
            <div class="flex gap-2">

                <form method="POST" action="{{ route('swap.accept', $r->id) }}">
                    @csrf
                    <button class="px-3 py-1 bg-green-600 rounded">
                        Accept
                    </button>
                </form>

                <form method="POST" action="{{ route('swap.reject', $r->id) }}">
                    @csrf
                    <button class="px-3 py-1 bg-red-600 rounded">
                        Reject
                    </button>
                </form>

            </div>
        @endif

        @if($r->status == 'accepted')
            <form method="POST" action="{{ route('swap.complete', $r->id) }}">
                @csrf
                <button class="mt-2 px-3 py-1 bg-purple-600 rounded">
                    Mark as Completed
                </button>
            </form>
        @endif

    </div>

    @empty
        <p class="text-gray-400">No incoming requests 😢</p>
    @endforelse

</div>
</x-app-layout>
