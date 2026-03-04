<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>

<body>
    <h3>Add a customer</h3>
    <form method="post" action="{{ route('customers.store') }}">
        @csrf
        Username: <input type="text" name="username"><br>
        Password: <input type="text" name="password"><br>
        Display Name: <input type="text" name="display_name"><br>
        Email: <input type="text" name="email"><br>
        Phone: <input type="text" name="phone"><br>
        Gender: <input type="radio" name="gender" value="M">Male <input type="radio" name="gender" value="F">Female <input type="radio" name="gender" value="O">Other<br>
        Birthday: <input type="date" name="birthday"><br>
        Address: <input type="text" name="address"><br>
        <input type="hidden" name="icon" value="">
        <button>Add</button>
    </form>
</body>

</html>
