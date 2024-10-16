<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>
<body>
    <div class="wrapper loginForm">
        <div class="logo d-flex justify-content-center mt-3 mb-3">
            <img src="{{ asset('assets/image/logo.png') }}" alt="">
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="inner">
            <form class="d-flex justify-content-center flex-column loginForm" id="loginForm" action="{{ route('login')}}" method="post">
                @csrf
                <h3>Sign In</h3>
                <div class="d-flex justify-content-center">
                    <span class="text-success" id="success"></span>
                </div>
                <div class="form-wrapper userName mt-2">
                    <input type="text" class="form-control userNameField" id="userName" name="userName" placeholder="Enter user name or email">
                </div>
                <div class="form-wrapper password mt-2">
                    <input type="password" class="form-control passwordField" id="password" name="password" placeholder="Enter password">
                </div>
                <span class="text-danger mt-2" id="error"></span>
                <div class="form-wrapper forgotPassword mt-2">
                    <p><a href="{{ route('forgotPasswordForm')}}">Forgot password?</a></p>
                </div>
                <div class="form-wrapper newUser mt-2">
                    <p>Don't have an account? <a href="{{ route('registrationForm')}}">Sign Up</a></p>    
                </div>
                <div class="submit mt-2" id="submit">
                    <input type="submit" class="btn btn-primary" id="login" value="Sign In">
                </div>
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>