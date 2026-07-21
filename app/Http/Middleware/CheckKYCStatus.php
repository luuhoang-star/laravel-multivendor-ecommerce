<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckKYCStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Đang chờ duyệt
        if ($user->kyc?->status == 'pending') {
            return redirect()->route('vendor.dashboard');
        }

        // Đã duyệt
        if ($user->kyc?->status == 'approved') {
            return redirect()->route('vendor.dashboard');
        }

        return $next($request);
    }
}
