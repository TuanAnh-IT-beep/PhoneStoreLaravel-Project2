<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Update a role</h3>
    <form method="post" action="{{route('roles.update', $role->id)}}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $role->id }}" />
        Name: <input type="text" name="name" value="{{ $role->name }}"><br>
        <button>Update</button>
    </form>
</body>
</html>
