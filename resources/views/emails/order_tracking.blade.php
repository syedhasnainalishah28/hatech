<!DOCTYPE html>
<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="dark only">
    <meta name="supported-color-schemes" content="dark only">
    <title>Order Update | HA Tech</title>
    <style>
        :root { color-scheme: dark only; supported-color-schemes: dark only; }
        html, body { background-color: #0a0506 !important; color: #ffffff !important; margin: 0 !important; padding: 0 !important; height: 100% !important; width: 100% !important; }
        table { border-collapse: collapse !important; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        @media only screen and (max-width: 620px) {
            .container { width: 100% !important; border-radius: 0 !important; border: none !important; }
            .header, .body, .footer { padding: 30px 20px !important; }
            h2 { font-size: 24px !important; }
        }
    </style>
</head>
<body style="background-color: #0a0506; color: #ffffff; margin: 0; padding: 0;">
    <div style="background-color: #0a0506; color: #ffffff; padding: 0; margin: 0; width: 100%;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#0a0506" style="background-color: #0a0506; table-layout: fixed;">
        <tr>
            <td align="center" style="padding: 40px 0; background-color: #0a0506;" bgcolor="#0a0506">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #1a0f11; border: 1px solid #d4a574; border-radius: 20px; overflow: hidden;" bgcolor="#1a0f11" class="container">
                    <tr>
                        <td align="center" style="padding: 40px; border-bottom: 1px solid rgba(212, 165, 116, 0.1); background-color: #1a0f11;" bgcolor="#1a0f11">
                            <img src="{{ $message->embed(public_path('logo.png')) }}" alt="Logo" width="80" height="auto" style="display: block; width: 80px; border-radius: 20px; margin-bottom: 15px;">
                            <h1 style="font-size: 24px; font-weight: 900; color: #d4a574 !important; letter-spacing: 2px; text-transform: uppercase; margin: 0; font-family: sans-serif;">HA Tech</h1>
                            <p style="font-size: 10px; color: #d4a574 !important; letter-spacing: 4px; margin: 5px 0 0 0; font-weight: 900; text-transform: uppercase; font-family: sans-serif;">GEN Z EVOLUTION</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px; background-color: #1a0f11;" bgcolor="#1a0f11">
                            <h2 style="font-size: 28px; font-weight: 900; color: #ffffff !important; text-transform: uppercase; letter-spacing: -0.02em; margin-bottom: 20px; font-family: sans-serif;">Project Evolution Update</h2>
                            <p style="line-height: 1.6; color: #cccccc !important; margin-bottom: 25px; font-size: 16px; font-family: sans-serif;">Your order <strong style="color: #ffffff !important;">#{{ $order->order_number }}</strong> has been updated.</p>
                            
                            <div style="margin-bottom: 30px;">
                                <span style="display: inline-block; padding: 10px 20px; background: rgba(212, 165, 116, 0.1); color: #d4a574 !important; font-weight: 900; border-radius: 50px; text-transform: uppercase; font-size: 11px; letter-spacing: 2px; border: 1px solid rgba(212, 165, 116, 0.2); font-family: sans-serif;">{{ strtoupper($order->status) }}</span>
                            </div>

                            <div align="center" style="padding-top: 20px;">
                                <a href="{{ route('user.orders') }}" style="display: inline-block; padding: 18px 36px; background-color: #d4a574 !important; color: #0a0506 !important; font-weight: 900; border-radius: 12px; text-decoration: none; text-transform: uppercase; font-size: 14px; letter-spacing: 1px; font-family: sans-serif;">Track Progress</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 40px; border-top: 1px solid rgba(212, 165, 116, 0.1); background-color: #150a0b;" bgcolor="#150a0b">
                            <p style="font-size: 11px; color: #888888 !important; margin: 5px 0; text-transform: uppercase; letter-spacing: 1.5px; font-family: sans-serif;">+92 325 9220167</p>
                            <p style="font-size: 11px; color: #888888 !important; margin: 5px 0; text-transform: uppercase; letter-spacing: 1.5px; font-family: sans-serif;">contact@hatechservices.com.pk</p>
                            <p style="margin-top: 25px; font-size: 9px; color: #666666 !important; font-family: sans-serif; text-transform: uppercase; letter-spacing: 1px;">&copy; {{ date('Y') }} HA Tech Services. All Rights Reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </div>
</body>
</html>
