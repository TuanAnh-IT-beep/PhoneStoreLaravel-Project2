<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>

<body>
    <h3>Permission List</h3>
    <a href="{{ route(name: 'specs.create') }}">Add a spec</a>
    <table border="1px" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th></th>
        </tr>
        @foreach ($specs as $spec)
            <tr>
                <td>
                    {{ $spec->id }}
                </td>
                <td>
                    {{ $spec->name }}
                </td>
                <td>
                    <a href="{{ route('specs.edit', $spec->id) }}">Edit</a>
                    <form method="post" action="{{ route('specs.delete', $spec->id) }}">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
