<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        .container
        {
            align-items: center;
            justify-content: center;
            display: flex;
        }
        .token-div
        {
            border-style: solid;
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Password Reset</h2>
            <p>Following is the 6 digit code for your password reset !</p>
            @php
            $email = $email;
            $token = $token;
            @endphp
            <div class="token-div">
                <h3>{{ $token }}</h3>
            </div>
        </div>
    </div>
</body>
</html>