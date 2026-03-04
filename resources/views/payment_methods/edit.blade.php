<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>Update a payment_method</h3>
    <form method="post" action="{{ route('payment_methods.update', $payment_method->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $payment_method->id }}" />
        Name: <input type="text" name="name" value="{{ $payment_method->name }}"><br>
        <input type="hidden" name="icon" value="">
        <button>Update</button>
    </form>
</body>

</html>
