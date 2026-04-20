<x-app-layout>
<div class="p-6 text-white max-w-2xl mx-auto">

    <!-- USER INFO -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold">{{ $user->name }}</h1>

        <!-- ⭐ AVG RATING -->
        <div class="mt-2 text-yellow-400 text-lg">
            ⭐ {{ number_format($avgRating ?? 0, 1) }}
            <span class="text-gray-400 text-sm">
                ({{ $totalReviews }} reviews)
            </span>
        </div>
    </div>

    <!-- REVIEWS -->
    <div class="space-y-4">

        @forelse($reviews as $r)

        <div class="bg-white/5 p-4 rounded-xl border border-white/10">

            <!-- STARS -->
            <div class="text-yellow-400">
                @for($i = 1; $i <= 5; $i++)
                    <span class="{{ $i <= $r->rating ? 'text-yellow-400' : 'text-gray-500' }}">
                        ★
                    </span>
                @endfor
            </div>

            <!-- COMMENT -->
            <p class="text-sm mt-2 text-gray-300">
                {{ $r->comment }}
            </p>

            <!-- REVIEWER -->
            <p class="text-xs text-gray-500 mt-2">
                <a href="{{ route('user.profile', $r->fromUser->id) }}" class="hover:underline">
                — {{ $r->fromUser->name }}
                </a>
            </p>

        </div>

        @empty
            <p class="text-gray-400 text-center">No reviews yet 😢</p>
        @endforelse

    </div>

</div>
</x-app-layout>
