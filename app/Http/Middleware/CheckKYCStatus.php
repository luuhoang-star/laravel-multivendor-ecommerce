<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckKYCStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        // Tránh vòng lặp chuyển hướng khi người dùng đã ở trang vendor.dashboard
        if ($request->routeIs('vendor.dashboard')) {
            return $next($request);
        }

        $user = auth()->user();

        // Nếu đã gửi KYC (chờ duyệt hoặc đã duyệt), chuyển hướng về vendor.dashboard
        if (in_array($user->kyc?->status, ['pending', 'approved'])) {
            return redirect()->route('vendor.dashboard');
        }

        return $next($request);
    }
}
