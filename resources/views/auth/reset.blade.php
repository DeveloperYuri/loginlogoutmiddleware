<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password Page</title>
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
    <div class="container">
        @include('_message')

        <div class="wrapper">
            <div class="title"><span>Reset Password Page</span></div>
            <form action="{{ url('reset_post/'.$token)}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" required name="password">
                </div>

                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" value="" placeholder="Confirm Password" required name="confirm_password">
                </div>
                
                <div class="row button">
                    <input type="submit" value="Reset Password">
                </div>

            </form>
        </div>
    </div>
</body>
</html>