<x-app-layout>
<div class="p-6 text-white">

    <h2 class="text-2xl font-bold mb-6">📥 Requests</h2>

    @if(session('success'))
        <div class="mb-4 text-green-400">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="mb-4 text-red-400">{{ session('error') }}</div>
    @endif

    <!-- ===================== -->
    <!-- 📥 INCOMING -->
    <!-- ===================== -->

    <h3 class="text-xl mb-4 text-yellow-400">Incoming Requests</h3>

    @forelse($incoming as $r)

        <div class="bg-white/5 p-4 rounded-xl mb-4 border border-white/10">
            <a href="{{ route('user.profile', $r->sender->id) }}" class="hover:underline">
            <h3 class="font-semibold">{{ $r->sender->name }}</h3>
            </a>
            <p class="text-sm">Wants: <span class="text-blue-400">{{ $r->skill_requested }}</span></p>
            <p class="text-sm mb-2">Offers: <span class="text-green-400">{{ $r->skill_offered }}</span></p>

            <p>Status:
            <span class="text-yellow-400">{{ ucfirst($r->status) }}</span>
            </p>
            <a href="{{ route('chat', $r->sender_id) }}"
                class="mt-2 block text-center bg-blue-500 py-2 rounded">
                💬 Chat
            </a>
            @if($r->status == 'pending')
            <div class="flex gap-2 mt-2">

                <form method="POST" action="{{ route('swap.accept', $r->id) }}">
                    @csrf
                    <button class="bg-green-600 px-3 py-1 rounded">Accept</button>
                </form>

                <form method="POST" action="{{ route('swap.reject', $r->id) }}">
                    @csrf
                    <button class="bg-red-600 px-3 py-1 rounded">Reject</button>
                </form>

            </div>
            @endif

            @if($r->status == 'accepted')

            <a href="{{ route('video.call', $r->id) }}"
                class="mt-2 inline-block bg-blue-600 px-3 py-1 rounded">
                🎥 Join Session
                </a>

            <form method="POST" action="{{ route('swap.complete', $r->id) }}">
                    @csrf
                    <button class="mt-2 bg-purple-600 px-3 py-1 rounded">Complete</button>
                </form>
            @endif

            @php
        $alreadyRated = \App\Models\Rating::where('swap_request_id', $r->id)
            ->where('from_user_id', auth()->id())
            ->exists();
    @endphp

    @if($r->status == 'completed' && !$alreadyRated)

        <form method="POST" action="{{ route('rating.store', $r->id) }}" class="mt-3">
            @csrf

            <select name="rating" required class="w-full mb-2 text-black">
                <option value="">Rate Sender</option>
                <option value="5">⭐⭐⭐⭐⭐</option>
                <option value="4">⭐⭐⭐⭐</option>
                <option value="3">⭐⭐⭐</option>
                <option value="2">⭐⭐</option>
                <option value="1">⭐</option>
            </select>
            <!-- 💬 comment -->
            <textarea name="comment"
                placeholder="Write your feedback..."
                class="w-full mb-2 px-2 py-1 rounded text-black"></textarea>

            <!-- 🔥 sender কে rate -->
            <input type="hidden" name="to_user_id" value="{{ $r->sender_id }}">

            <button class="bg-yellow-500 px-3 py-1 rounded w-full">
                Submit Rating
            </button>
        </form>

    @endif

    @if($alreadyRated)
        <p class="text-green-400 mt-2">⭐ You already rated</p>
    @endif
    </div>

    @empty
        <p class="text-gray-400 mb-6">No incoming requests</p>
    @endforelse


    <!-- ===================== -->
    <!-- 📤 SENT -->
    <!-- ===================== -->

    <h3 class="text-xl mb-4 text-blue-400 mt-8">Sent Requests</h3>

    @forelse($sent as $r)

    <div class="bg-white/5 p-4 rounded-xl mb-4 border border-white/10">
        <a href="{{ route('user.profile', $r->receiver->id) }}" class="hover:underline">
        <h3 class="font-semibold">{{ $r->receiver->name }}</h3>
        </a>
        <p class="text-sm">Wants: <span class="text-blue-400">{{ $r->skill_requested }}</span></p>
        <p class="text-sm mb-2">Offers: <span class="text-green-400">{{ $r->skill_offered }}</span></p>

        <p>Status:
            <span class="text-yellow-400">{{ ucfirst($r->status) }}</span>
        </p>
        <a href="{{ route('chat', $r->receiver_id) }}"
                class="mt-2 block text-center bg-blue-500 py-2 rounded">
                💬 Chat
        </a>
        @if($r->status == 'accepted')

        <a href="{{ route('video.call', $r->id) }}"
       class="mt-2 inline-block bg-blue-600 px-3 py-1 rounded">
       🎥 Join Session
        </a>

        @endif
        <!-- ⭐ rating -->
        @php
            $alreadyRated = \App\Models\Rating::where('swap_request_id', $r->id)
                ->where('from_user_id', auth()->id())
                ->exists();
        @endphp

        @if($r->status == 'completed' && !$alreadyRated)

            <form method="POST" action="{{ route('rating.store', $r->id) }}" class="mt-3">
                @csrf

                <select name="rating" required class="w-full mb-2 text-black">
                    <option value="">Rate</option>
                    <option value="5">⭐⭐⭐⭐⭐</option>
                    <option value="4">⭐⭐⭐⭐</option>
                    <option value="3">⭐⭐⭐</option>
                    <option value="2">⭐⭐</option>
                    <option value="1">⭐</option>
                </select>
                <!-- 💬 comment -->
                <textarea name="comment"
                placeholder="Write your feedback..."
                class="w-full mb-2 px-2 py-1 rounded text-black"></textarea>

                <input type="hidden" name="to_user_id" value="{{ $r->receiver_id }}">

                <button class="bg-yellow-500 px-3 py-1 rounded w-full">
                    Submit Rating
                </button>
            </form>

        @endif

    </div>

    @empty
        <p class="text-gray-400">No sent requests</p>
    @endforelse

</div>
</x-app-layout>
