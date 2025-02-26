<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Reset OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 480px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .logo {
            width: 100px;
            margin-bottom: 20px;
        }
        .otp-code {
            font-size: 24px;
            font-weight: bold;
            background: #007bff;
            color: #fff;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 3px;
            margin: 10px 0;
            letter-spacing: 2px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
        p {
            font-size: 18px;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h2>Password Reset Request</h2>
        <p>Hello <b> {{ $email }} </b>,</p>
        <p>You recently requested to reset your password. Use the OTP below to proceed.</p>
        <p class="otp-code">{{ $otp }}</p>
        <p>This OTP is valid for <strong>10 minutes</strong>. Do not share it with anyone.</p>
        <p class="footer">If you did not request this, please ignore this email.</p>
    </div>
</body>
</html>
