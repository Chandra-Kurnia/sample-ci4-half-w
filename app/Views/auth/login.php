<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <style>
        body{
            margin: 100px;
        }
        input{
            margin: 10px;
        }
    </style>
</head>
<body>
    <div>
        <form action="/login" method="POST">
            <input type="text" name="email">
            <input type="password" name="password">
            <button>login</button>
        </form>
    </div>
</body>
</html>