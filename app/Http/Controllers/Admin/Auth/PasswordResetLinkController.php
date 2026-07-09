<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Notifications\ResetPassword; // Gửi mail reset password
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password; // Xử lý reset password
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    // Hiển thị form quên mật khẩu
    public function create(): View
    {
        return view('admin.auth.forgot-password'); // View nhập email
    }


    // Xử lý gửi link reset password
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'], // Kiểm tra email
        ]);


        // Gửi link reset cho Admin
        $status = Password::broker('admins')->sendResetLink(
            $request->only('email'), // Lấy email nhập từ form


            function ($user, $token) {

                $notification = new ResetPassword($token); // Tạo mail reset


                $notification->createUrlUsing(function () use ($user, $token) {

                    return route('admin.password.reset', [
                        'token' => $token, // Token reset
                        'email' => $user->getEmailForPasswordReset(), // Email Admin
                    ]);
                });


                $user->notify($notification); // Gửi mail
            }
        );


        return $status == Password::RESET_LINK_SENT

            ? back()->with('status', __($status)) // Thành công

            : back()
                ->withInput($request->only('email')) // Giữ email
                ->withErrors([
                    'email' => __($status), // Báo lỗi
                ]);
    }
}