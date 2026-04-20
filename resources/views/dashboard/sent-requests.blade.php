<x-app-layout>
<div class="p-6 text-white">

    <h2 class="text-2xl font-bold mb-6">📤 Sent Requests</h2>

    @if(session('success'))
        <div class="mb-4 text-green-400">{{ session('success') }}</div>
    @endif

    @forelse($requests as $r)

    <div class="bg-white/5 p-4 rounded-xl border border-white/10 mb-4">

        <!-- RECEIVER -->
        <h3 class="text-lg font-semibold mb-2">
            {{ $r->receiver->name }}
        </h3>

        <!-- SKILLS -->
        <p class="text-sm mb-1">
            Wants to learn:
            <span class="text-blue-400">{{ $r->skill_requested }}</span>
        </p>

        <p class="text-sm mb-2">
            Offers:
            <span class="text-green-400">{{ $r->skill_offered }}</span>
        </p>

        <!-- STATUS -->
        <p class="mb-3 text-sm">
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

        <!-- ⭐ RATING -->
        @php
            $alreadyRated = \App\Models\Rating::where('swap_request_id', $r->id)
                ->where('from_user_id', auth()->id())
                ->exists();
        @endphp

        @if($r->status == 'completed' && !$alreadyRated)

            <div class="mt-3 border-t border-white/10 pt-3">

                <p class="text-yellow-400 text-sm mb-2">⭐ Rate receiver</p>

                <form method="POST" action="{{ route('rating.store', $r->id) }}">
                    @csrf

                    <select name="rating" required
                        class="w-full mb-2 px-3 py-1 rounded bg-black text-white">
                        <option value="">Select Rating</option>
                        <option value="5">⭐⭐⭐⭐⭐</option>
                        <option value="4">⭐⭐⭐⭐</option>
                        <option value="3">⭐⭐⭐</option>
                        <option value="2">⭐⭐</option>
                        <option value="1">⭐</option>
                    </select>

                    <textarea name="comment"
                        placeholder="Write feedback..."
                        class="w-full px-3 py-1 rounded bg-black text-white mb-2"></textarea>

                    <!-- 🔥 receiver কে rate -->
                    <input type="hidden" name="to_user_id" value="{{ $r->receiver_id }}">

                    <button class="w-full py-1 bg-yellow-500 text-black rounded">
                        Submit Rating
                    </button>
                </form>

            </div>

        @endif

        @if($alreadyRated)
            <p class="text-green-400 mt-2">⭐ You already rated</p>
        @endif

    </div>

    @empty
        <p class="text-gray-400">No sent requests 😢</p>
    @endforelse

</div>
</x-app-layout>
