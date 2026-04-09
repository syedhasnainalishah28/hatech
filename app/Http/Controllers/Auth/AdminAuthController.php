<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\AdministrativeLog;
use App\Mail\AdminSecurityMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // 1. Rate Limiting (6 attempts per minute)
        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($throttleKey, 6)) {
            $this->logActivity(null, 'login_throttled', 'Exceeded login attempts.');
            return back()->withErrors(['email' => 'Too many login attempts. Please wait 60 seconds.']);
        }

        // 2. Strong Password Validation (already enforced in database level usually, but here for UI)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:12',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        // 3. Generic Error Message & Auth Check
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            RateLimiter::hit($throttleKey);
            $this->logActivity(null, 'login_failed', "Failed login attempt for email: {$request->email}");
            
            // Alert if it's a known admin email
            if ($admin) {
                $this->sendSecurityAlert($admin, 'Failed Login Attempt', 'Someone tried to log in with your email and failed.');
            }

            return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
        }

        // 4. Success -> Generate 2FA OTP
        RateLimiter::clear($throttleKey);
        
        $otp = rand(100000, 999999);
        $admin->update([
            'two_factor_code' => $otp,
            'two_factor_expires_at' => now()->addMinutes(10)
        ]);

        // Send OTP
        try {
            Mail::to('syedhasnainalishah28@gmail.com')->send(new AdminSecurityMail('otp', ['otp' => $otp]));
        } catch (\Exception $e) {
            \Log::error("OTP Mail Error: " . $e->getMessage());
        }

        session(['admin_login_email' => $admin->email]);

        return redirect()->route('admin.2fa');
    }

    public function show2fa()
    {
        if (!session('admin_login_email')) return redirect()->route('admin.login');
        return view('admin.auth.2fa');
    }

    public function verify2fa(Request $request)
    {
        $request->validate(['code' => 'required|numeric']);
        
        $email = session('admin_login_email');
        $admin = Admin::where('email', $email)->first();

        if (!$admin || $admin->two_factor_code != $request->code || now()->gt($admin->two_factor_expires_at)) {
            $this->logActivity($admin?->id, '2fa_failed', 'Invalid or expired OTP entered.');
            return back()->withErrors(['code' => 'Invalid or expired code.']);
        }

        // Success -> Final Login
        $admin->update([
            'two_factor_code' => null,
            'two_factor_expires_at' => null,
            'last_login_at' => now(),
            'last_login_ip' => $request->ip()
        ]);

        Auth::guard('admin')->login($admin);
        
        $this->logActivity($admin->id, 'login_success', 'Successful administrative login.');
        $this->sendSecurityAlert($admin, 'Successful Login', 'Administrative access granted.');

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $adminId = Auth::guard('admin')->id();
        Auth::guard('admin')->logout();
        $this->logActivity($adminId, 'logout', 'Admin logged out.');
        return redirect()->route('admin.login');
    }

    private function logActivity($adminId, $action, $description)
    {
        $ua = request()->header('User-Agent');
        
        AdministrativeLog::create([
            'admin_id' => $adminId,
            'action' => $action,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => $ua,
            'os_name' => $this->getOS($ua),
            'device_type' => $this->getDevice($ua),
            'browser_name' => $this->getBrowser($ua)
        ]);
    }

    private function sendSecurityAlert($admin, $event, $details)
    {
        $data = [
            'event' => $event,
            'details' => $details,
            'ip' => request()->ip(),
            'os' => $this->getOS(request()->header('User-Agent')),
            'device' => $this->getDevice(request()->header('User-Agent')),
            'browser' => $this->getBrowser(request()->header('User-Agent'))
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
