@extends('admin.layout')
@section('content')
    <h1 class="text-2xl mb-6">Dashboard</h1>

    <div class="grid grid-cols-3 gap-6">
        <div class="bg-white/5 p-6 rounded-xl border border-white/10">
            <p class="text-gray-400">Total Users</p>
            <h2 class="text-3xl font-bold">{{ $totalUsers }}</h2>
        </div>
    </div>

    <h2 class="text-xl font-bold mt-8 mb-4">User Management</h2>
    <table class="min-w-full bg-gray-800 rounded-lg overflow-hidden">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-600">Name</th>
                <th class="py-2 px-4 border-b border-gray-600">Email</th>
                <th class="py-2 px-4 border-b border-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>

                <td>{{ $user->email }}</td>

                <td class="flex gap-2">

        <!-- DELETE -->
        <form action="{{ route('admin.user.delete', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="text-red-400 hover:text-red-600">
                Delete
            </button>
        </form>

        <!-- BAN -->
        <form action="{{ route('admin.user.ban', $user->id) }}" method="POST">
            @csrf
            <button class="text-yellow-400 hover:text-yellow-600">
                Ban
            </button>
        </form>

        <!-- REPORT -->
        <form action="{{ route('admin.user.report', $user->id) }}" method="POST">
            @csrf
            <button class="text-blue-400 hover:text-blue-600">
                Report
            </button>
        </form>

    </td>
</tr>
@endforeach
