<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 12 Form Validation</title>
</head>
<body>

<h2>Laravel 12 Form Validation Example</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ url('/form') }}" method="POST">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name">
    </div>
    <br>
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email">
    </div>
    <br>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password">
    </div>
    <br>
    <button type="submit">Submit</button>
</form>

</body>
</html>
