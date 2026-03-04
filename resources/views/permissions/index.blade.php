<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>

<body>
    <h3>Permission List</h3>
    <a href="{{ route(name: 'permissions.create') }}">Add a permission</a>
    <table border="1px" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th></th>
        </tr>
        @foreach ($permissions as $permission)
            <tr>
                <td>
                    {{ $permission->id }}
                </td>
                <td>
                    {{ $permission->type }}
                </td>
                <td>
                    <a href="{{ route('permissions.edit', $permission->id) }}">Edit</a>
                    <form method="post" action="{{ route('permissions.delete', $permission->id) }}">
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
