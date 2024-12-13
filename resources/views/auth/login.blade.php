<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
    <div class="container">
        @include('_message')

        <div class="wrapper">
            <div class="title"><span>Login Page</span></div>
            <form action="{{ url('login_post')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="email" value="{{ old('email')}}" placeholder="Email" required name="email">
                </div>

                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" value="" placeholder="Password" required name="password">
                </div>

                <div class="pass">
                    <a href="{{ url('forgot')}}">Forgot Password</a>
                </div>
                
                <div class="row button">
                    <input type="submit" value="Login">
                </div>

                <div class="signup-link">
                    Join Now? <a href="{{ url('registration')}}">Registration</a>
                </div>

                <div class="signup-link">
                    Welcome Page? <a href="{{ url('/')}}"> Welcome Page</a>
                </div>

            </form>
        </div>
    </div>
</body>
</html>