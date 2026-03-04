<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    <h3>Add a role</h3>
    <form method="post" action="{{ route('roles.store') }}">
        @csrf
        Name: <input type="text" name="name"><br>
        <button>Add</button>
    </form>
</body>
</html>
