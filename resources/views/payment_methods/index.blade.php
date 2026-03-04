<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>

<body>
    <h3>Manufacturer List</h3>
    <a href="{{ route(name: 'payment_methods.create') }}">Add a payment_method</a>
    <table border="1px" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th></th>
        </tr>
        @foreach ($payment_methods as $payment_method)
            <tr>
                <td>
                    {{ $payment_method->id }}
                </td>
                <td>
                    {{ $payment_method->name }}
                </td>
                <td>
                    <a href="{{ route('payment_methods.edit', $payment_method->id) }}">Edit</a>
                    <form method="post" action="{{ route('payment_methods.delete', $payment_method->id) }}">
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
