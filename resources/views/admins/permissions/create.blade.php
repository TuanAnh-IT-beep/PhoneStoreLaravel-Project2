<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    <h3>Add a permission</h3>
    <form method="post" action="{{ route('permissions.store') }}">
        @csrf
        Type: <input type="text" name="type"><br>
        <button>Add</button>
    </form>
</body>
</html>
