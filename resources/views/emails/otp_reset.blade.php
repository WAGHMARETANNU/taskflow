<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset OTP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8fffe;
        }
        .container {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-top: 4px solid #aad2c1;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #2c5f54;
            font-size: 28px;
            margin: 0;
        }
        .otp-box {
            background: linear-gradient(135deg, #aad2c1, #7fb6a4);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin: 20px 0;
        }
        .otp-code {
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 6px;
            font-family: 'Courier New', monospace;
            margin: 10px 0;
        }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Password Reset Request</h1>
        </div>
        
        <p>Hello @if(isset($data) && $data['name']){{ $data['name'] }}@else{{ $name ?? 'User' }}@endif,</p>
        
        <p>You have requested to reset your password for your To Do List App account. Please use the following One-Time Password (OTP) to proceed:</p>
        
        <div class="otp-box">
            <div>Your OTP Code:</div>
            <div class="otp-code">{{ $otp ?? $data['otp'] ?? '000000' }}</div>
        </div>
        
        <div class="warning">
            <strong>Security Notice:</strong>
            <ul style="margin: 10px 0; padding-left: 20px;">
                <li>This OTP is valid for <strong>10 minutes</strong> only</li>
                <li>Do not share this code with anyone</li>
                <li>If you didn't request this, please ignore this email</li>
            </ul>
        </div>
        
        <p>After entering the OTP, you will be able to set a new password for your account.</p>
        
        <div class="footer">
            <p>Best regards,<br><strong>To Do List App Team</strong></p>
            <p><small>This is an automated email. Please do not reply to this message.</small></p>
        </div>
    </div>
</body>
</html>
