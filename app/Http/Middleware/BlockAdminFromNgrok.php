<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockAdminFromNgrok
{
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();
        
        if (str_contains($host, 'ngrok') && $request->is('admin*')) {
            abort(403, 'Admin panel not accessible through Ngrok. Use localhost instead.');
        }

        return $next($request);
    }
}
