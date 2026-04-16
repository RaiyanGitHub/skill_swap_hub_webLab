<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
            Profile Settings ⚙️
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 py-10">
        <div class="max-w-5xl mx-auto px-6 space-y-8">

            <!-- Profile Info -->
            <div class="bg-white/80 backdrop-blur-lg shadow-xl rounded-2xl p-8">
                <h3 class="text-xl font-semibold mb-4 text-indigo-600">
                    👤 Profile Information
                </h3>

                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Password -->
            <div class="bg-white/80 backdrop-blur-lg shadow-xl rounded-2xl p-8">
                <h3 class="text-xl font-semibold mb-4 text-green-600">
                    🔐 Update Password
                </h3>

                @include('profile.partials.update-password-form')
            </div>

            <!-- Delete -->
            <div class="bg-white/80 backdrop-blur-lg shadow-xl rounded-2xl p-8 border border-red-300">
                <h3 class="text-xl font-semibold mb-4 text-red-600">
                    ⚠️ Danger Zone
                </h3>

                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>
