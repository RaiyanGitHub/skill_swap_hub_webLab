<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#0b1120] text-white">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="w-60 bg-white/5 backdrop-blur-md p-6 border-r border-white/10">
        <h2 class="text-xl font-bold mb-6">ADMIN</h2>

        <nav class="space-y-3">
            <a href="/admin/dashboard" class="block hover:text-cyan-400">Dashboard</a>
            <a href="/admin/users" class="block hover:text-cyan-400">Users</a>
            <a href="/admin/reports" class="block hover:text-cyan-400">Reports</a>
        </nav>
    </div>

    <!-- CONTENT -->
    <div class="flex-1 p-8">
        @yield('content')
    </div>

</div>

</body>
</html>
