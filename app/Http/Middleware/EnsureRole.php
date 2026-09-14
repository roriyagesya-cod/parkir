<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureRole
{
    /**
     * Usage in routes: ->middleware('role:admin') or ->middleware('role:admin,owner')
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        $allowed = explode(',', $roles);

        if (! in_array($request->session()->get('user_role'), $allowed, true)) {
            abort(403, 'Peran Anda tidak memiliki izin untuk membuka halaman ini.');
        }

        return $next($request);
    }
}
