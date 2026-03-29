<!DOCTYPE html>
<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="dark only">
    <meta name="supported-color-schemes" content="dark only">
    <title>{{ $template->subject }}</title>
    <style>
        :root { color-scheme: dark only; supported-color-schemes: dark only; }
        html, body { background-color: #0a0506 !important; color: #ffffff !important; margin: 0 !important; padding: 0 !important; height: 100% !important; width: 100% !important; }
        table { border-collapse: collapse !important; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { border: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
        
        /* Gmail Dark Mode Fix */
        @media (prefers-color-scheme: dark) {
            .container { background-color: #1a0f11 !important; }
            .body-text, .footer-text { color: #cccccc !important; }
        }

        @media only screen and (max-width: 620px) {
            .container { width: 100% !important; border-radius: 0 !important; border: none !important; }
            .header, .body, .footer { padding: 30px 20px !important; }
            h2 { font-size: 24px !important; }
        }
    </style>
</head>
<body style="background-color: #0a0506; color: #ffffff; margin: 0; padding: 0;">
    <!-- Outer Wrapper to force background -->
    <div style="background-color: #0a0506; color: #ffffff; padding: 0; margin: 0; width: 100%;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#0a0506" style="background-color: #0a0506; table-layout: fixed; width: 100% !important;">
        <tr>
            <td align="center" style="padding: 40px 0; background-color: #0a0506;" bgcolor="#0a0506">
                <!-- Inner Container -->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #1a0f11; border: 1px solid #d4a574; border-radius: 20px; overflow: hidden;" bgcolor="#1a0f11" class="container">
                    <!-- Header -->
                    <tr>
                        <td align="center" style="padding: 40px; border-bottom: 1px solid rgba(212, 165, 116, 0.1); background-color: #1a0f11;" bgcolor="#1a0f11">
                            @if($template->logo_path)
                                <img src="{{ $message->embed(storage_path('app/public/' . $template->logo_path)) }}" alt="Logo" width="80" height="auto" style="display: block; width: 80px; border-radius: 20px; margin-bottom: 15px;">
                            @else
                                <img src="{{ $message->embed(public_path('logo.png')) }}" alt="Logo" width="80" height="auto" style="display: block; width: 80px; border-radius: 20px; margin-bottom: 15px;">
                            @endif
                            <h1 style="font-size: 24px; font-weight: 900; color: #d4a574 !important; letter-spacing: 2px; text-transform: uppercase; margin: 0; font-family: 'Helvetica Neue', Arial, sans-serif;">{{ $template->brand_name }}</h1>
                            <p style="font-size: 10px; color: #d4a574 !important; letter-spacing: 4px; margin: 5px 0 0 0; font-weight: 900; text-transform: uppercase; font-family: sans-serif;">{{ $template->tagline }}</p>
                        </td>
                    </tr>
                    
                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 40px; background-color: #1a0f11;" bgcolor="#1a0f11">
                            @php
                                $parsedContent = str_replace('{name}', $user->name, $customMessage);
                                $parsedContent = str_replace('{email}', $user->email, $parsedContent);
                            @endphp
                            <div style="line-height: 1.7; color: #cccccc !important; font-size: 16px; font-family: 'Helvetica Neue', Arial, sans-serif;">
                                {!! nl2br($parsedContent) !!}
                            </div>

                            <!-- CTA Button -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" style="padding-top: 40px;">
                                        <a href="{{ url('/login') }}" style="display: inline-block; padding: 18px 36px; background-color: #d4a574 !important; color: #0a0506 !important; font-weight: 900; border-radius: 12px; text-decoration: none; text-transform: uppercase; font-size: 14px; letter-spacing: 1px; font-family: sans-serif;">Access Platform</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding: 40px; border-top: 1px solid rgba(212, 165, 116, 0.1); background-color: #150a0b;" bgcolor="#150a0b">
                            <p style="font-size: 11px; color: #888888 !important; margin: 5px 0; text-transform: uppercase; letter-spacing: 1.5px; font-family: sans-serif;">{{ $template->contact_phone }}</p>
                            <p style="font-size: 11px; color: #888888 !important; margin: 5px 0; text-transform: uppercase; letter-spacing: 1.5px; font-family: sans-serif;">{{ $template->contact_email }}</p>
                            <p style="font-size: 11px; color: #888888 !important; margin: 5px 0; text-transform: uppercase; letter-spacing: 1.5px; font-family: sans-serif;">{{ $template->website_url }}</p>
                            
                            <!-- Social Links -->
                            <div style="margin-top: 20px;">
                                <a href="#" style="color: #d4a574 !important; text-decoration: none; font-weight: bold; margin: 0 10px; font-size: 11px; font-family: sans-serif;">INSTAGRAM</a>
                                <a href="#" style="color: #d4a574 !important; text-decoration: none; font-weight: bold; margin: 0 10px; font-size: 11px; font-family: sans-serif;">LINKEDIN</a>
                                <a href="#" style="color: #d4a574 !important; text-decoration: none; font-weight: bold; margin: 0 10px; font-size: 11px; font-family: sans-serif;">WHATSAPP</a>
                            </div>
                            <!-- Copyright Fix -->
                            <p style="margin-top: 25px; font-size: 9px; color: #666666 !important; font-family: sans-serif; text-transform: uppercase; letter-spacing: 1px;">
                                &copy; {{ date('Y') }} {{ $template->brand_name }} Services. All Rights Reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </div>
</body>
</html>
