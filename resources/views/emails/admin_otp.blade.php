<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Inter', sans-serif; background: #000; color: #fff; padding: 40px; }
        .box { border: 1px solid #d4a574; padding: 30px; border-radius: 12px; max-width: 500px; margin: auto; }
        .otp { font-size: 32px; font-weight: bold; color: #d4a574; letter-spacing: 5px; text-align: center; margin: 20px 0; }
        .footer { font-size: 12px; color: #555; text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="box">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ $message->embed(public_path('logo.png')) }}" alt="HA Tech" style="width: 60px; border-radius: 12px;">
        </div>
        <h2 style="color: #d4a574; text-align: center; margin-top: 0; letter-spacing: 2px;">SECURE ACCESS</h2>
        <p style="text-align: center; color: #ccc;">A login attempt was made for your administrative account.</p>
        <div class="otp">{{ $data['otp'] }}</div>
        <p style="text-align: center; font-size: 13px; color: #888;">This code will expire in 10 minutes. <br> If you did not request this, please change your password immediately.</p>
        <div class="footer">
            &copy; {{ date('Y') }} HA TECH SYSTEMS. PROPRIETARY & CONFIDENTIAL.
        </div>
    </div>
</body>
</html>
