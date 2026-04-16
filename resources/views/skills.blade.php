<!DOCTYPE html>
<html>
<head>
    <title>My Skills</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 p-10">

    <h1 class="text-2xl font-bold mb-6">My Skills</h1>

    <div class="grid grid-cols-2 gap-4">
        @foreach($skills as $skill)
            <div class="bg-white p-4 rounded shadow">
                {{ $skill }}
            </div>
        @endforeach
    </div>

</body>
</html>
