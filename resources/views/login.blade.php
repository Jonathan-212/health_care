<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .shadowBox {
            border: 1px solid;
            padding: 10px;
            box-shadow: 5px 10px 18px #b6b6b6;
            border:none;
            border-radius: 15px;
        }
        .btn-primary{
            background-color:#E74646;
        }
        .btn-primary:hover{
            background-color:#FA9884;
        }
    </style>
</head>
<body style="background-color:#f0f0f0">
    <form action="/user/login" method="POST" enctype="multipart/form-data" class="shadowBox" style="background-color:#ffffff; width: 500px; padding:50px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        {{ csrf_field() }}

        <div style="font-family: sans-serif; font-weight:bold; color:#E74646; font-size:25px">HEALTHcare</div>

        <div style="margin-bottom:20px">Hi, Welcome Back!</div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group" style="margin-top: 15px">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1" style="background-color:#FA9884; border:none; ">
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
        </div>

        @if($failed == 1)
            <div style="color: red; font-size:14px">
                Wrong combination of email and password. Try Again!
            </div>
        @endif
        <button type="submit" class="btn btn-primary" style="display:block; margin:20px auto 0px auto; border:none">Login</button>

        <div style="display: flex; margin-top:10px">
            <a href="/user/register" style="text-decoration: none; display:block; margin:0 auto; color:#FA9884">Do not have an account? Register now!</a>
        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
