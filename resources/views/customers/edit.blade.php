<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>Update a customer</h3>
    <form method="post" action="{{ route('customers.update', $customer->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $customer->id }}" />
        Username: <input type="text" name="username" value="{{ $customer->username }}"><br>
        Display Name: <input type="text" name="display_name" value="{{ $customer->display_name }}"><br>
        Email: <input type="text" name="email" value="{{ $customer->email }}"><br>
        Phone: <input type="text" name="phone" value="{{ $customer->phone }}"><br>
        Gender: <input type="radio" name="gender" value="{{ $customer->gender }}">{{ $customer->gender }}
        Birthday: <input type="date" name="birthday" value="{{ $customer->birthday }}"><br>
        Address: <input type="text" name="address" value="{{ $customer->address }}"><br>
        <input type="hidden" name="icon" value="">
        <button>Update</button>
    </form>
</body>

</html>
