<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    <h3>Add a payment method</h3>
    <form method="post" action="{{ route('payment_methods.store') }}">
        @csrf
        Name: <input type="text" name="name"><br>
        <input type="hidden" name="icon" value="">
        <button>Add</button>
    </form>
</body>
</html>
