<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
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
    </style>
</head>
<body style="background-color:#f0f0f0">
    <form action="/user/register" method="POST" enctype="multipart/form-data" class="shadowBox" style="background-color:#ffffff; width: 500px; padding:30px 50px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        {{ csrf_field() }}

        <div style="font-family: sans-serif; font-weight:bold; color:#142474; font-size:25px">HEALTHcare</div>

        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="string" class="form-control" name="name" id="name" placeholder="Enter full name">
        </div>
        <div class="form-group" style="margin-top:15px">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="row" style="margin-top:15px">
            <div class="col">
                <div class="form-group">
                    <label for="height">Height</label>
                    <input type="string" class="form-control" name="height" id="height" placeholder="Enter height">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="string" class="form-control" name="weight" id="weight" placeholder="Enter weight">
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:15px">
            <div class="col">
                <div class="form-group">
                    <label for="phoneNumber">Phone Number</label>
                    <input type="string" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="Enter phone number">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="Enter DOB">
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:15px">
            <div class="col">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Enter password">
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div style="color: red; font-size:14px">
                {{$errors->first()}}
            </div>
        @endif

        <button type="submit" class="btn btn-primary" style="display:block; margin:20px auto 0px auto; border:none">Signup</button>

        <div style="display: flex; margin-top:10px">
            <a href="/user/login" style="text-decoration: none; display:block; margin:0 auto; color:#1e38bb">Aleady have an account? Login now!</a>
        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
