<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>Update a category</h3>
    <form method="post" action="{{ route('categories.update', $category->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $category->id }}" />
        Name: <input type="text" name="name" value="{{ $category->name }}"><br>
        Description: <input type="text" name="description" value="{{ $category->description }}"><br>
        <button>Update</button>
    </form>
</body>

</html>
