<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500">

        <div class="w-full max-w-md bg-white/10 backdrop-blur-lg rounded-2xl shadow-xl p-8 text-white">

            <h2 class="text-2xl font-bold text-center mb-6">Welcome Back 👋</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block mb-1 text-sm">Email</label>
                    <input type="email" name="email"
                     placeholder="Enter your email"
                     class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30
                     text-black placeholder-gray-300 caret-white
                     focus:ring-2 focus:ring-indigo-400 outline-none">
                </div>

                <!-- Password -->
                <div class="mt-4 relative">
                    <label class="block mb-1 text-sm">Password</label>

                    <input id="password" type="password" name="password"
                    class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30
                    text-black placeholder-gray-300
                    focus:ring-2 focus:ring-indigo-400 outline-none">


                    <!-- Show/Hide Button -->
                    <span onclick="togglePassword()"
                        class="absolute right-3 top-9 cursor-pointer text-sm text-gray-300">
                        show
                    </span>
                </div>
                @error('email')
                        <p class="text-red-400 text-sm mt-2">
                         ❌ Invalid email or password
                        </p>
                @enderror

                <!-- Error -->
                @error('email')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror

                <!-- Remember -->
                <div class="mt-4 flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    <span class="text-sm">Remember me</span>
                </div>

                <!-- Button -->
                <div class="mt-6 flex justify-between items-center">
                    <a href="#" class="text-sm text-gray-300 hover:underline">
                        Forgot password?
                    </a>

                    <button type="submit"
                        class="bg-white text-indigo-600 px-5 py-2 rounded-lg font-semibold hover:bg-gray-200 transition">
                        Login
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- JS -->
    <script>
        function togglePassword() {
            let input = document.getElementById("password");
            input.type = input.type === "password" ? "text" : "password";
        }


    </script>
</x-guest-layout>
