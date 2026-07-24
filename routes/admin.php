<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\KYCRequestController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin') // middleware 'guest:admin sẽ kiểm tra xem người dùng có phải guard admin hay ko qua RedirectIfauthenticated, nếu là guard admin thì sẽ check xem người dùng đã đăng nhập chưa, nếu đã đăng nhập thì sẽ redirect về trang dashboard của admin, nếu chưa đăng nhập thì sẽ cho phép truy cập vào các route bên trong group này.
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.store');
    });

Route::middleware('auth:admin') // middleware 'auth:admin' sẽ kiểm tra xem người dùng có phải guard admin hay ko qua Authenticate, nếu là guard admin thì sẽ check xem người dùng đã đăng nhập chưa, nếu chưa đăng nhập thì sẽ redirect về trang login của admin, nếu đã đăng nhập thì sẽ cho phép truy cập vào các route bên trong group này.
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('verify-email', EmailVerificationPromptController::class)
            ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');

        Route::get('profile', [ProfileController::class, 'index'])
            ->name('profile.index');

        Route::put('profile/update',[ProfileController::class, 'profileUpdate'])->name('profile.update');
        Route::put('/password/update', [ProfileController::class, 'passwordUpdate'])->name('profile.password.update');

        /* KYC Routes */
        Route::get('kyc', [KYCRequestController::class, 'index'])->name('kyc.index');
        Route::get('kyc/pending', [KYCRequestController::class, 'pending'])->name('kyc.pending');
        Route::get('kyc/rejected', [KYCRequestController::class, 'rejected'])->name('kyc.rejected');
        Route::get('kyc/{kyc_request}', [KYCRequestController::class, 'show'])->name('kyc.show');
        Route::get('kyc/{kyc_request}/download', [KYCRequestController::class, 'download'])->name('kyc.download');
        Route::put('kyc/{kyc_request}/update', [KYCRequestController::class, 'update'])->name('kyc.update');

        /* Role Resource Route */
        Route::resource('role', RoleController::class);

        /* Role User Resource Route */
        Route::resource('role-user', RoleUserController::class);
    });




Route::get('/admin/dashboard', function () {
    return view('admin.dashboard.index');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');
