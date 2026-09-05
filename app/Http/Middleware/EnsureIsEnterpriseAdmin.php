<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureIsEnterpriseAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isEnterpriseAdmin()) {
            abort(403, 'Bạn không có quyền truy cập khu vực quản lý doanh nghiệp.');
        }

        return $next($request);
    }
}
