<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Navbar</title>
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
            background-color:#142474;
        }
        .btn-primary:hover{
            background-color:#1e38bb;
        }
        html, body {
            height: 100%;
        }
        .navbarr{
            width: 300px;
            background-color:#142474;
            height:100%;
            padding: 50px 40px;
            color: white;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        .menu{
            text-decoration: none; color:white; margin-bottom:15px
        }
        .menu:hover{
            color:#FFF3E2;
        }
    </style>
</head>
<body style="background-color:#f0f0f0; display:flex;">
    <div class="navbarr">
        <a href="/" class="menu" style="margin-bottom:50px;"><div style="font-family: sans-serif; font-size:25px; font-weight:bold; ">HEALTHcare</div></a>

        <a href="/" class="menu">Dashboard</a>
        <a href="/consultation" class="menu">Doctor Consultation</a>
        <a href="/medicine" class="menu">My Medicine</a>
        <a href="/setting" class="menu">Setting</a>

        <a href="/user/logout" class="menu" style="position: absolute; bottom:0px; margin-bottom: 50px">Logout</a>
    </div>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
