<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    <h3>Add a manufacturer</h3>
    <form method="post" action="{{ route('manufacturers.store') }}">
        @csrf
        Name: <input type="text" name="name"><br>
        Description: <input type="text" name="description"><br>
        <input type="hidden" name="icon" value="">
        <button>Add</button>
    </form>
</body>
</html>
