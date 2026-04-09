<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AdministrativeLog;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminSecurityMail;

class SanitizeFileUploads
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasFile('*')) {
            $files = $request->allFiles();
            $forbidden = ['php', 'php3', 'php4', 'php5', 'phtml', 'exe', 'sh', 'py', 'js', 'jsp', 'cgi', 'pl', 'asp', 'aspx'];

            foreach ($files as $fileKey => $file) {
                if (is_array($file)) {
                    foreach ($file as $subFile) {
                        $this->validateFile($subFile, $request);
                    }
                } else {
                    $this->validateFile($file, $request);
                }
            }
        }

        return $next($request);
    }

    private function validateFile($file, $request)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $forbidden = ['php', 'php3', 'php4', 'php5', 'phtml', 'exe', 'sh', 'py', 'js', 'jsp', 'cgi', 'pl', 'asp', 'aspx', 'vbs', 'com'];

        if (in_array($extension, $forbidden)) {
            // Log this incident
            $ua = $request->header('User-Agent');
            AdministrativeLog::create([
                'action' => 'blocked_file_upload',
                'description' => "Blocked illegal file upload attempt: .{$extension}",
                'ip_address' => $request->ip(),
                'user_agent' => $ua,
                'os_name' => $this->getOS($ua),
                'device_type' => $this->getDevice($ua),
                'browser_name' => $this->getBrowser($ua),
                'payload' => ['filename' => $file->getClientOriginalName()]
            ]);

            // Alert Admin
            $this->alertAdmin($extension, $request);

            abort(403, 'Illegal file extension detected. This incident has been logged.');
        }
    }

    private function alertAdmin($ext, $request)
    {
        $data = [
            'event' => 'Illegal File Upload Blocked',
            'details' => "An attempt to upload a .{$ext} file was intercepted.",
            'ip' => $request->ip(),
            'os' => $this->getOS($request->header('User-Agent')),
            'device' => $this->getDevice($request->header('User-Agent')),
            'browser' => $this->getBrowser($request->header('User-Agent'))
        ];

        try {
            Mail::to('syedhasnainalishah28@gmail.com')->send(new AdminSecurityMail('alert', $data));
        } catch (\Exception $e) {
            \Log::error("Security Alert Mail Error: " . $e->getMessage());
        }
    }

    // Basic UA Parsers
    private function getOS($ua) {
        if (preg_match('/windows|win32/i', $ua)) return 'Windows';
        if (preg_match('/android/i', $ua)) return 'Android';
        if (preg_match('/iphone|ipad|ipod/i', $ua)) return 'iOS';
        if (preg_match('/macintosh|mac os x/i', $ua)) return 'macOS';
        return 'Unknown';
    }

    private function getDevice($ua) {
        if (preg_match('/mobile|android|iphone|ipad|ipod/i', $ua)) return 'Mobile';
        return 'Desktop';
    }

    private function getBrowser($ua) {
        if (preg_match('/chrome/i', $ua)) return 'Chrome';
        if (preg_match('/firefox/i', $ua)) return 'Firefox';
        if (preg_match('/safari/i', $ua)) return 'Safari';
        return 'Browser';
    }
}
