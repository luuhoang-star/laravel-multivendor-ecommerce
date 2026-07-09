<?php
//bộ Controller xử lý xác thực người dùng(là phải xác thực email): từ authenticatedSessionController.php đến verifyEmailController.php, tất cả đều nằm trong thư mục Auth của Admin
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('admin.auth.login');  // hiện form trang đăng nhập của admin
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse // xử lý xác thực người dùng admin
    {
        $request->authenticate(); // Xác thực email và mật khẩu.

        $request->session()->regenerate(); //Tạo Session ID mới để tăng bảo mật.

        return redirect()->intended(route('admin.dashboard', absolute: false)); // Chuyển hướng người dùng đến trang dashboard của admin sau khi đăng nhập thành công.
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();  // Đăng xuất người dùng khỏi guard 'admin'.

        $request->session()->invalidate();  // Hủy bỏ tất cả dữ liệu trong session để đảm bảo rằng thông tin đăng nhập cũ không còn tồn tại.

        $request->session()->regenerateToken(); // Tạo lại token CSRF mới để bảo vệ chống lại các cuộc tấn công CSRF.

        return redirect('/'); // Chuyển hướng người dùng về trang chủ sau khi đăng xuất.
    }
}
