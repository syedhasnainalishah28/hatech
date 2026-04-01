<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the provider authentication page.
     *
     * @param string $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the provider.
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            // Generate a random password if a new account is created since password is required by some systems
            // although we made it nullable
            $providerIdField = $provider . '_id';
            
            $user = User::where($providerIdField, $socialUser->getId())
                        ->orWhere('email', $socialUser->getEmail())
                        ->first();
                        
            if ($user) {
                // Link the account if they used a different method to sign up previously
                if (!$user->$providerIdField) {
                    $user->update([
                        $providerIdField => $socialUser->getId(),
                        'avatar' => $user->avatar ?? $socialUser->getAvatar(),
                    ]);
                }
                
                Auth::login($user, true);
            } else {
                // Create a new user
                $user = User::create([
                    'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
                    'email' => $socialUser->getEmail(),
                    $providerIdField => $socialUser->getId(),
                    'role' => 'buyer', // Default role 'buyer' mapping to 'client'
                    'status' => 'active',
                    'avatar' => $socialUser->getAvatar(),
                    // password remains null
                ]);
                
                Auth::login($user, true);
            }
            
            return redirect()->route('user.dashboard')->with('success', 'Successfully logged in with ' . ucfirst($provider));
            
        } catch (Exception $e) {
            Log::error('Social Login Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Authentication failed or was canceled.');
        }
    }
}
