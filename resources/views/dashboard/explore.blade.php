<x-app-layout>
<div class="p-6 text-white">

    <!--  SEARCH -->
    <form method="GET" class="mb-6">
        <input type="text" name="search" placeholder="Search skill..."
            value="{{ request('search') }}"
            class="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white">
    </form>

    <h2 class="text-xl font-bold mb-4">🔎 Explore Skills</h2>

    <div class="grid md:grid-cols-2 gap-4">

        @forelse($users as $u)

        <div class="bg-white/5 p-4 rounded-xl border border-white/10">

            <!-- NAME -->
            <h3 class="text-lg font-semibold mb-2">
            <a href="{{ route('user.profile', $u->id) }}" class="hover:underline">
                {{ $u->name }}
            </a>
            </h3>

            <!-- KNOW -->
            <div class="mb-2">
                <p class="text-green-400 text-sm">Knows:</p>

                <div class="flex flex-wrap gap-2 mt-1">
                    @foreach($u->skills->where('type','know') as $skill)
                        <span class="bg-green-500/20 px-2 py-1 rounded text-sm">
                            {{ $skill->name }}
                        </span>
                    @endforeach
                </div>
            </div>

            <!-- LEARN -->
            <div class="mb-3">
                <p class="text-blue-400 text-sm">Wants:</p>

                <div class="flex flex-wrap gap-2 mt-1">
                    @foreach($u->skills->where('type','learn') as $skill)
                        <span class="bg-blue-500/20 px-2 py-1 rounded text-sm">
                            {{ $skill->name }}
                        </span>
                    @endforeach
                </div>
            </div>

        <!-- BUTTON -->
        <form method="POST" action="{{ route('swap.send', $u->id) }}">
            @csrf

            <!-- 🔥 skill_offered (current user knows) -->
            <input type="hidden" name="skill_offered"
            value="{{ auth()->user()->skills->where('type','know')->first()->name ?? '' }}">

            <!-- 🔥 skill_requested (target user wants) -->
            <input type="hidden" name="skill_requested"
            value="{{ $u->skills->where('type','learn')->first()->name ?? '' }}">

            <button class="w-full py-2 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg">
                Request Swap
            </button>
        </form>

        </div>

        @empty
            <div class="text-center text-gray-400 col-span-2">
                No users found 😢
            </div>
        @endforelse

    </div>

</div>
</x-app-layout>
