<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\Authenticate;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use App\Http\Middleware\RedirectIfAuthenticated;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting( //withRouting() dùng để đăng ký những file route mà Laravel cần đọc khi khởi động.
        web: [ // Các route trong những file này sẽ được đăng ký và tự động áp dụng middleware "web" (Session, Cookie, CSRF Protection, Authentication, ...).
             __DIR__.'/../routes/web.php',
             __DIR__.'/../routes/admin.php'
        ],
        
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth' => Authenticate::class, // Đăng ký middleware "auth" với lớp Authenticate. Khi một route sử dụng middleware "auth", nó sẽ kiểm tra xem người dùng đã xác thực hay chưa. Nếu chưa xác thực, người dùng sẽ được chuyển hướng đến trang đăng nhập.
            'guest' => RedirectIfAuthenticated::class, // Đăng ký middleware "guest" với lớp RedirectIfAuthenticated. Khi một route sử dụng middleware "guest", nó sẽ kiểm tra xem người dùng đã xác thực hay chưa. Nếu đã xác thực, người dùng sẽ được chuyển hướng đến một trang khác (thường là trang chủ hoặc bảng điều khiển).
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
 