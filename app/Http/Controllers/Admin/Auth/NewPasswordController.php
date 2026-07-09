<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin; // Model Admin
use Illuminate\Auth\Events\PasswordReset; // Event reset password
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Mã hóa password
use Illuminate\Support\Facades\Password; // Reset password
use Illuminate\Support\Str; // Tạo chuỗi random
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    public function create(Request $request): View
    {
        return view('admin.auth.reset-password', ['request' => $request]); // Hiển thị form đổi mật khẩu
    }


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'], // Kiểm tra token
            'email' => ['required', 'email'], // Kiểm tra email
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // Kiểm tra password
        ]);


        $status = Password::broker('admins')->reset( // Reset password Admin

            $request->only('email', 'password', 'password_confirmation', 'token'), // Lấy dữ liệu form


            function (Admin $user) use ($request) {

                $user->forceFill([
                    'password' => Hash::make($request->password), // Mã hóa password mới
                    'remember_token' => Str::random(60), // Tạo token mới
                ])->save(); // Lưu vào database


                event(new PasswordReset($user)); // Gọi event sau reset
            }
        );


        return $status == Password::PASSWORD_RESET

            ? redirect()->route('admin.login') // Thành công về trang login
                ->with('status', __($status))

            : back() // Thất bại quay lại
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => __($status),
                ]);
    }
}