<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link rel="stylesheet" href="{{asset('assets/css/mailVerification.css')}}">
</head>
<body>
    <div class="container">
        <h1>Welcome to User Management System!</h1>
        <p>Hi {{$userName}},</p>
        <p>Thank you for registering with us! Please verify your email address by clicking the button below:</p>
        <a href="{{$url}}" class="button">Verify Email Address</a>
        <p>If the button doesn't work, please copy and paste the following link into your browser:</p>
        <p>{{$url}}</p>
        <p>Thank you for joining us!</p>
        <p>Best Regards,<br>User Management System Team</p>
        <div class="footer">
            <p>If you did not register for this account, please ignore this email.</p>
        </div>
    </div>
</body>
</html>