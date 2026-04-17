@extends('admin.layout')

@section('content')

<h1 class="text-2xl mb-6">Users</h1>

@if(session('success'))
    <div class="mb-4 text-green-400">{{ session('success') }}</div>
@endif

<table class="w-full text-left border border-white/10 rounded-xl overflow-hidden">

    <tr class="bg-white/10">
        <th class="p-3">Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>

    @foreach($users as $user)
    <tr class="border-t border-white/10">
        <td class="p-3">{{ $user->name }}</td>
        <td>{{ $user->email }}</td>

        <td class="space-x-2">

            <!-- DELETE -->
            <form method="POST" action="/admin/user/{{ $user->id }}" class="inline">
                @csrf
                @method('DELETE')
                <button class="text-red-400">Delete</button>
            </form>

            <!-- BAN -->
            <button onclick="banEmail('{{ $user->email }}')" class="text-yellow-400">
                Ban
            </button>

        </td>
    </tr>
    @endforeach

</table>

<!-- BAN FORM -->
<form id="banForm" method="POST" action="/admin/ban">
    @csrf
    <input type="hidden" name="email" id="banEmailInput">
</form>

<script>
function banEmail(email) {
    if(confirm("Ban this email?")) {
        document.getElementById('banEmailInput').value = email;
        document.getElementById('banForm').submit();
    }
}
</script>

@endsection
