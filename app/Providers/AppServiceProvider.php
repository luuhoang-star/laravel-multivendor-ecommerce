<?php

namespace App\Providers;

use App\Constants\Role;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Tự động cấp toàn bộ quyền truy cập (bypassing permissions) cho tài khoản có vai trò Super Admin
        Gate::before(function ($user, $ability) {
            return $user->hasRole(Role::SUPER_ADMIN) ? true : null;
        });
    }
}
