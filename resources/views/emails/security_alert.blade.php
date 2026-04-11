<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Inter', sans-serif; background: #000; color: #fff; padding: 40px; }
        .box { border: 1px solid #ff4444; padding: 30px; border-radius: 12px; max-width: 600px; margin: auto; }
        .alert { color: #ff4444; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td { padding: 10px; border-bottom: 1px solid #333; font-size: 14px; }
        .label { color: #888; width: 120px; }
    </style>
</head>
<body>
    <div class="box">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ $message->embed(public_path('logo.png')) }}" alt="HA Tech" style="width: 60px; border-radius: 12px;">
        </div>
        <h2 class="alert" style="text-align: center; margin-top: 0;">SECURITY ALERT: {{ $data['event'] }}</h2>
        <p style="text-align: center; color: #ccc;">A critical event was detected on the HA Tech Secure Portal. Details below:</p>
        
        <table>
            <tr><td class="label">IP Address:</td><td>{{ $data['ip'] }}</td></tr>
            <tr><td class="label">Device/OS:</td><td>{{ $data['device'] }} / {{ $data['os'] }}</td></tr>
            <tr><td class="label">Browser:</td><td>{{ $data['browser'] }}</td></tr>
            <tr><td class="label">Timestamp:</td><td>{{ date('Y-m-d H:i:s') }}</td></tr>
            @if(isset($data['details']))
            <tr><td class="label">Details:</td><td>{{ $data['details'] }}</td></tr>
            @endif
        </table>

        <p style="margin-top: 25px; color: #888; text-align: center; font-size: 13px;">If this was not you, please secure your server and databases immediately.</p>
        <div style="text-align: center; font-size: 11px; color: #555; margin-top: 30px; letter-spacing: 1px;">
            &copy; {{ date('Y') }} HA TECH SECURITY MONITOR. ALL SYSTEMS TRACKED.
        </div>
    </div>
</body>
</html>
