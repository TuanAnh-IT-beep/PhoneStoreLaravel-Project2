<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>

<body>
    <h3>Role List</h3>
    <a href="{{ route(name: 'roles.create') }}">Add a role</a>
    <table border="1px" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th></th>
        </tr>
        @foreach ($roles as $role)
            <tr>
                <td>
                    {{ $role->id }}
                </td>
                <td>
                    {{ $role->name }}
                </td>
                <td>
                    <a href="{{ route('roles.edit', $role->id) }}">Edit</a>
                    <form method="post" action="{{ route('roles.delete', $role->id) }}">
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
