<x-app-layout>
<div class="p-6 text-white max-w-xl mx-auto">

    <h2 class="text-xl font-bold mb-4">💬 Messages</h2>

    @forelse($users as $u)

        <a href="{{ route('chat', $u->id) }}"
           class="block bg-white/5 p-4 rounded-lg mb-3 hover:bg-white/10">

            <h3 class="font-semibold">{{ $u->name }}</h3>

            <p class="text-sm text-gray-400">
                {{ $u->last_message ?? 'No messages yet' }}
            </p>

        </a>

    @empty
        <p class="text-gray-400">No conversations yet 😢</p>
    @endforelse

</div>
</x-app-layout>
