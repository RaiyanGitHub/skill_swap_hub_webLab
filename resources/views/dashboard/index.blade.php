<x-app-layout>
    <div class="p-6">

        <h1 class="text-2xl font-bold mb-6">Dashboard 🚀</h1>
        <div class="grid grid-cols-3 gap-4">
            <a href="{{ route('requests.incoming') }}"
            class="bg-white rounded-lg text-black">
            📥 Requests
        </a>
            <!-- Skills Card -->
            <a href="{{ route('dashboard.skills') }}">
    <div class="bg-white p-6 rounded shadow cursor-pointer hover:scale-105 transition">

        <h2 class="text-blue-500">Your Skills</h2>

        <!-- 🔥 total -->
        <p class="text-xl font-bold">{{ $skillsCount }}</p>

        <!-- 🔥 optional breakdown -->
        <div class="text-sm text-gray-500 mt-2">
            Know: {{ $skillsKnowCount }} | Learn: {{ $skillsLearnCount }}
        </div>

    </div>
</a>

        <!-- Explore Skills -->

            <a href="{{ route('dashboard.explore') }}">
            <div
                class="bg-white p-6 rounded shadow">
                <h2 class="text-green-500">🔎 Explore & Match</h2>
                 <p class="text-xl font-bold">2</p>
            </div>
            </a>

            <!-- Swaps -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-green-500">Swaps</h2>
                <p class="text-xl font-bold">3</p>
            </div>

            <!-- Messages -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-red-500">Messages</h2>
                <p class="text-xl font-bold">4</p>
            </div>



        </div>

    </div>
</x-app-layout>
