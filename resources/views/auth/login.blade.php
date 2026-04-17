<x-guest-layout>
<div class="min-h-screen flex items-center justify-center relative bg-[#0b1120] overflow-hidden">

    <!-- BACKGROUND -->
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1518770660439-4636190af475')]
                bg-cover bg-center opacity-30 blur-sm"></div>

    <!-- CARD -->
    <div class="relative w-full max-w-md p-8 rounded-2xl
                bg-white/5 backdrop-blur-xl border border-white/10
                shadow-[0_0_60px_rgba(255,255,255,0.15)]">

        <!-- LOGO -->
        <div class="text-center mb-6">
            <h3 class="text-white text-xl font-semibold">SKILL SWAP HUB</h3>
            <h3 class="text-2xl text-white font-bold mt-2">Sign In</h3>
        </div>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
            <div class="mb-4 p-2 text-green-400 text-sm text-center border border-green-500 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- EMAIL -->
            <div class="mb-4">
                <label class="text-sm text-gray-300">Email address</label>

                <div class="relative mt-1">
                    <input type="email" name="email"
                        class="w-full px-4 py-2 rounded-lg bg-transparent border border-white/20 text-white
                               focus:ring-2 focus:ring-blue-400 outline-none"
                        placeholder="you@example.com" required>
                </div>
            </div>

            <!-- PASSWORD -->
            <div class="mb-4">
                <label class="text-sm text-gray-300">Password</label>

                <div class="relative mt-1">
                    <input id="password" type="password" name="password"
                        class="w-full px-4 py-2 pr-16 rounded-lg bg-transparent border border-white/20 text-white
                               focus:ring-2 focus:ring-blue-400 outline-none"
                        required>

                    <!-- SHOW BUTTON -->
                    <button type="button"
                        onclick="togglePassword()"
                        class="absolute right-3 top-2 text-sm text-gray-400 hover:text-white">
                        Show
                    </button>
                </div>

                <!-- REMEMBER + FORGOT -->
                <div class="flex items-center justify-between mt-2">

                    <label class="flex items-center text-sm text-gray-400 cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="mr-2 rounded border-gray-600 bg-transparent text-blue-500 focus:ring-blue-400">
                        Remember me
                    </label>

                    <a href="#" class="text-xs text-gray-400 hover:text-white">
                        Forgot Password?
                    </a>

                </div>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full py-2 rounded-full bg-gradient-to-r from-gray-700 to-gray-900
                       text-white font-semibold hover:scale-[1.02] transition shadow-lg">
                Sign In
            </button>

            <!-- DIVIDER -->
            <div class="flex items-center my-5">
                <div class="flex-1 h-px bg-white/20"></div>
                <span class="px-3 text-gray-400 text-sm">Or continue with</span>
                <div class="flex-1 h-px bg-white/20"></div>
            </div>

            <!-- SOCIAL -->
            <div class="flex justify-center gap-4 mb-4">
                <button type="button" class="p-2 rounded-lg border border-white/20 text-white">G</button>
                <button type="button" class="p-2 rounded-lg border border-white/20 text-white">🐙</button>
            </div>

            <!-- SIGN UP -->
            <p class="text-center text-sm text-gray-400">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-white underline">Sign up</a>
            </p>

        </form>
    </div>

</div>
</x-guest-layout>

<script>
function togglePassword() {
    const input = document.getElementById("password");
    input.type = input.type === "password" ? "text" : "password";
}
</script>
