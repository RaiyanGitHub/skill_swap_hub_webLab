<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-4xl mx-auto space-y-6">

        <div class="bg-white shadow-lg rounded-xl p-6">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-white shadow-lg rounded-xl p-6">
            @include('profile.partials.update-password-form')
        </div>

        <div class="bg-white shadow-lg rounded-xl p-6 border border-red-300">
            @include('profile.partials.delete-user-form')
        </div>

    </div>
</div>
