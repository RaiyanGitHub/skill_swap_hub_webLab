<x-guest-layout>
<div class="min-h-screen flex items-center justify-center relative bg-[#0b1120] overflow-hidden">

    <!-- BACKGROUND BLUR (IMPORTANT) -->
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1518770660439-4636190af475')]
                bg-cover bg-center opacity-30 blur-sm"></div>

    <!-- CARD -->
    <div class="relative w-full max-w-sm p-8 rounded-2xl
                bg-white/5 backdrop-blur-xl border border-white/10
                shadow-[0_0_60px_rgba(255,255,255,0.15)]">

        <!-- HEADER -->
        <div class="text-center mb-6">
            <h2 class="text-white text-lg font-semibold tracking-wide">SKILL SWAP HUB</h2>
            <h3 class="text-2xl text-white font-bold mt-2">Sign Up</h3>
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- NAME -->
            <div class="mb-4">
                <label class="text-sm text-gray-300">Full Name</label>
                <input type="text" name="name"
                    class="w-full px-4 py-2 mt-1 rounded-lg bg-white/5 border border-white/20 text-white
                           focus:ring-2 focus:ring-cyan-400 outline-none"
                    placeholder="John Doe" required>
            </div>

            <!-- EMAIL -->
            <div class="mb-4">
                <label class="text-sm text-gray-300">Email address</label>
                <input type="email" name="email"
                    class="w-full px-4 py-2 mt-1 rounded-lg bg-white/5 border border-white/20 text-white
                           focus:ring-2 focus:ring-cyan-400 outline-none"
                    placeholder="you@example.com" required>
            </div>

            <!-- PASSWORD -->
            <div class="mb-4">
                <label class="text-sm text-gray-300">Password</label>

                <div class="relative mt-1">
                    <input id="password" type="password" name="password"
                        class="w-full px-4 py-2 pr-16 rounded-lg bg-white/5 border border-white/20 text-white
                               focus:ring-2 focus:ring-cyan-400 outline-none"
                        required>

                    <button type="button"
                        onclick="togglePassword()"
                        class="absolute right-3 top-2 text-sm text-gray-400 hover:text-white">
                        Show
                    </button>
                </div>
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="mb-4">
                <label class="text-sm text-gray-300">Confirm Password</label>

                <div class="relative mt-1">
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="w-full px-4 py-2 pr-16 rounded-lg bg-white/5 border border-white/20 text-white
                               focus:ring-2 focus:ring-cyan-400 outline-none"
                        required>
                </div>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full py-2 mt-2 rounded-full bg-gradient-to-r from-gray-700 to-gray-900
                       text-white font-semibold hover:opacity-90 transition shadow-lg">
                Register
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

            <!-- LOGIN LINK -->
            <p class="text-center text-sm text-gray-400">
                Already have an account?
                <a href="{{ route('login') }}" class="text-white underline">Sign in</a>
            </p>

        </form>
    </div>

</div>
</x-guest-layout>

<script>
function togglePassword() {
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("password_confirmation");

    const type = password.type === "password" ? "text" : "password";

    if (password) password.type = type;
    if (confirmPassword) confirmPassword.type = type;
}
</script>
