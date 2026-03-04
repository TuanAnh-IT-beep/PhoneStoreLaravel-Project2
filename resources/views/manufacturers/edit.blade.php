<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>Update a manufacturer</h3>
    <form method="post" action="{{ route('manufacturers.update', $manufacturer->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $manufacturer->id }}" />
        Name: <input type="text" name="name" value="{{ $manufacturer->name }}"><br>
        Description: <input type="text" name="description" value="{{ $manufacturer->description }}"><br>
        <input type="hidden" name="icon" value="">
        <button>Update</button>
    </form>
</body>

</html>
