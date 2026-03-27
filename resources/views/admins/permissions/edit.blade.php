<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>Update a permission</h3>
    <form method="post" action="{{ route('permissions.update', $permission->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $permission->id }}" />
        Type: <input type="text" name="type" value="{{ $permission->type }}"><br>
        <button>Update</button>
    </form>
</body>

</html>
