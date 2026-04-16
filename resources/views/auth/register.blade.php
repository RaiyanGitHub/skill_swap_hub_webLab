<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
       <div class="mt-4">
            <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <!-- FIXED WRAPPER -->
                <div class="relative mt-1">

                <!-- INPUT -->
                <input id="password"
                 type="password"
                 name="password"
                 required
                 class="w-full px-4 py-2 pr-16 rounded-lg bg-black/20 border border-black/30 font-medium text-sm text-gray-700 dark:text-gray-300 outline-none">

                <!-- SHOW BUTTON -->
                <button type="button"
                    onclick="togglePassword()"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-sm text-gray-300 hover:text-white">
                    show
                </button>

            </div>

            <div class="mt-2">
                <p id="strengthText" class="text-sm text-gray-500"></p>

            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<script>
    function togglePassword() {
    const input = document.getElementById("password");
    const input2 = document.getElementById("password_confirmation");
    input.type = input.type === "password" ? "text" : "password";
    input2.type = input2.type === "password" ? "text" : "password";
}
       const passwordInput = document.getElementById("password");
    const strengthText = document.getElementById("strengthText");

    passwordInput.addEventListener("input", () => {
        let val = passwordInput.value;

        if (val.length < 6) {
            strengthText.innerText = "Weak password ❌";
        } else if (val.length < 10) {
            strengthText.innerText = "Medium password ⚠️";
        } else {
            strengthText.innerText = "Strong password ✅";
        }
    });
</script>
