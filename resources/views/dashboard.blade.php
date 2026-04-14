<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
            Dashboard 🚀
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 py-10">
        <div class="max-w-6xl mx-auto px-6">

            <!-- Welcome Card -->
            <div class="bg-white/70 backdrop-blur-lg shadow-xl rounded-2xl p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    Welcome, {{ auth()->user()->name }} 👋
                </h1>
                <p class="text-gray-600">
                    Ready to swap your skills today?
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white rounded-xl shadow-lg p-6 hover:scale-105 transition">
                    <h3 class="text-lg font-semibold text-indigo-600">Your Skills</h3>
                    <p class="text-2xl font-bold mt-2">5</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 hover:scale-105 transition">
                    <h3 class="text-lg font-semibold text-green-600">Swaps</h3>
                    <p class="text-2xl font-bold mt-2">3</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 hover:scale-105 transition">
                    <h3 class="text-lg font-semibold text-pink-600">Messages</h3>
                    <p class="text-2xl font-bold mt-2">2</p>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
