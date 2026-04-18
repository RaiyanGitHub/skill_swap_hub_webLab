{{--Deprecated but the editor or code breaks when this file is deleted so find a way to remove it safely in the future--}}
<x-app-layout>
    <div class="p-6">

        <h1 class="text-2xl font-bold mb-6">Dashboard 🚀</h1>

        <div class="grid grid-cols-3 gap-4">

            <!-- Skills Card -->
            <a href="{{ route('dashboard.skills') }}">
                <div class="bg-white p-6 rounded shadow cursor-pointer hover:scale-105 transition">
                    <h2 class="text-blue-500">Your Skills</h2>
                    <p class="text-xl font-bold">5</p>
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
                <p class="text-xl font-bold">2</p>
            </div>

            <-- Explore Skills -->
            <div>
            <a href="{{ route('dashboard.explore') }}"
                class="bg-indigo-500 px-40 py-20 rounded-lg text-black font-bold text-lg hover:bg-indigo-600 transition">
                🔎 Explore & Match
            </a>
            </div>

        </div>

    </div>
</x-app-layout>
