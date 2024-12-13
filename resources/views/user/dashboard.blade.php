<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Dashboard Page</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="title">
                <span>User Dashboard</span>
            </div>

            <form action="">
                <div class="row">
                    <p><b>Name - </b>{{ $getRecord->name }}</p>
                    <p><b>Email - </b>{{ $getRecord->email }}</p>
                </div>

                <div class="signup-link">
                    Logout?
                    <a href="{{ url('logout') }}">Logout</a>
                </div>

                <div class="signup-link">
                    HomePage?
                    <a href="{{ url('/') }}">Welcome Page</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
