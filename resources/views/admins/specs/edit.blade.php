<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>Update a spec</h3>
    <form method="post" action="{{ route('specs.update', $spec->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $spec->id }}" />
        Name: <input type="text" name="name" value="{{ $spec->name }}"><br>
        <button>Update</button>
    </form>
</body>

</html>
