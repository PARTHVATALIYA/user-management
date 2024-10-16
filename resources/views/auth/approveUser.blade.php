<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Verification Notification</title>
    <link rel="stylesheet" href="{{asset('assets/css/approveUser.css')}}">
</head>
<body>
    <div class="container">
        <h1>User Email Verified!</h1>
        <p>Dear Admin,</p>
        <p>We are pleased to inform you that a user has successfully verified their email address.</p>
        <p><strong>User Details:</strong></p>
        <ul>
            <li><strong>Name:</strong> {{$userName}}</li>
            <li><strong>Email:</strong> {{$email}}</li>
        </ul>
        <p>Please click the button below to approve this user:</p>
        <a href="{{$redirectUrl}}" class="button">Approve User</a>
        <p>If the button doesn't work, please copy and paste the following link into your browser:</p>
        <p>{{$redirectUrl}}</p>
        <p>Thank you for your attention!</p>
        <p>Best Regards,<br>User Management System Team</p>
        <div class="footer">
            <p>This is an automated message. Please do not reply.</p>
        </div>
    </div>
</body>
</html>