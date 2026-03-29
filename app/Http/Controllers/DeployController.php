<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class DeployController extends Controller
{
    private $secret = 'HA_TECH_SECRET_2026';

    public function migrate(Request $request) {
        if ($request->token !== $this->secret) {
            return response('Access Denied', 403);
        }

        try {
            Artisan::call('migrate', ['--force' => true]);
            $output = Artisan::output();
            return response("Migration Successful:<br><pre>$output</pre>");
        } catch (\Exception $e) {
            return response("Migration Failed:<br>" . $e->getMessage(), 500);
        }
    }

    public function clearCache(Request $request) {
        if ($request->token !== $this->secret) {
            return response('Access Denied', 403);
        }

        Artisan::call('optimize:clear');
        return response("Cache Cleared Successfully.");
    }
}
