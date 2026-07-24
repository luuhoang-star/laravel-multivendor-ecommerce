<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Permission as PermissionConstant;
use App\Constants\Role as RoleConstant;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\AlertService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RoleUserController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:' . PermissionConstant::MANAGE_ADMIN_ACCOUNT),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Eager load roles to prevent N+1 query issue
        $admins = Admin::with('roles')->latest('id')->get();

        return view('admin.role-user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Loại bỏ Super Admin khỏi danh sách vai trò có thể gán
        $roles = Role::where('guard_name', RoleConstant::GUARD_ADMIN)
            ->where('name', '!=', RoleConstant::SUPER_ADMIN)
            ->get();

        return view('admin.role-user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,id'],
        ], [
            'name.required' => 'Vui lòng nhập tên tài khoản.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Email này đã tồn tại trong hệ thống.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'role.required' => 'Vui lòng chọn vai trò cho tài khoản.',
            'role.exists' => 'Vai trò được chọn không hợp lệ.',
        ]);

        $role = Role::findOrFail($request->role);

        // Bảo vệ vai trò Super Admin
        if ($role->name === RoleConstant::SUPER_ADMIN) {
            AlertService::error('Không thể gán vai trò Super Admin!');
            return redirect()->back();
        }

        DB::transaction(function () use ($request, $role) {
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Gán Role cho tài khoản Admin
            $admin->assignRole($role);
        });

        AlertService::created('Tạo tài khoản Admin mới thành công!');

        return to_route('admin.role-user.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $role_user): View|RedirectResponse
    {
        // Bảo vệ không cho sửa tài khoản Super Admin
        if ($role_user->hasRole(RoleConstant::SUPER_ADMIN) || $role_user->email === RoleConstant::SUPER_ADMIN_EMAIL) {
            AlertService::error('Không thể chỉnh sửa tài khoản Super Admin!');
            return redirect()->route('admin.role-user.index');
        }

        $admin = $role_user;
        $roles = Role::where('guard_name', RoleConstant::GUARD_ADMIN)
            ->where('name', '!=', RoleConstant::SUPER_ADMIN)
            ->get();

        return view('admin.role-user.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $role_user): RedirectResponse
    {
        // Bảo vệ không cho sửa tài khoản Super Admin
        if ($role_user->hasRole(RoleConstant::SUPER_ADMIN) || $role_user->email === RoleConstant::SUPER_ADMIN_EMAIL) {
            AlertService::error('Không thể chỉnh sửa tài khoản Super Admin!');
            return redirect()->route('admin.role-user.index');
        }

        $admin = $role_user;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,' . $admin->id],
            'role' => ['required', 'exists:roles,id'],
        ], [
            'name.required' => 'Vui lòng nhập tên tài khoản.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Email này đã tồn tại trong hệ thống.',
            'role.required' => 'Vui lòng chọn vai trò cho tài khoản.',
            'role.exists' => 'Vai trò được chọn không hợp lệ.',
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ], [
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự.',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            ]);
        }

        $role = Role::findOrFail($request->role);

        // Bảo vệ vai trò Super Admin
        if ($role->name === RoleConstant::SUPER_ADMIN) {
            AlertService::error('Không thể gán vai trò Super Admin!');
            return redirect()->back();
        }

        DB::transaction(function () use ($request, $admin, $role) {
            $admin->name = $request->name;
            $admin->email = $request->email;

            if ($request->filled('password')) {
                $admin->password = Hash::make($request->password);
            }

            $admin->save();

            // Đồng bộ và ghi đè lại Vai trò cho tài khoản Admin
            $admin->syncRoles([$role]);
        });

        AlertService::updated('Cập nhật tài khoản Admin thành công!');

        return to_route('admin.role-user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $role_user): JsonResponse|RedirectResponse
    {
        $isAjax = request()->ajax() || request()->wantsJson() || request()->header('X-Requested-With') === 'XMLHttpRequest';

        // Bảo vệ tài khoản Super Admin không thể xóa
        if ($role_user->email === RoleConstant::SUPER_ADMIN_EMAIL || $role_user->hasRole(RoleConstant::SUPER_ADMIN)) {
            if ($isAjax) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Không thể xóa tài khoản Super Admin!'
                ], 400);
            }
            AlertService::error('Không thể xóa tài khoản Super Admin!');
            return redirect()->back();
        }

        try {
            DB::transaction(function () use ($role_user) {
                // Thu hồi tất cả các vai trò trước khi xóa tài khoản
                $role_user->syncRoles([]);

                // Xóa tài khoản Admin
                $role_user->delete();
            });

            AlertService::deleted('Xóa tài khoản Admin thành công!');

            if ($isAjax) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Xóa tài khoản Admin thành công!'
                ]);
            }

            return to_route('admin.role-user.index');
        } catch (\Throwable $e) {
            Log::error('Role User Delete Error: ' . $e->getMessage());

            if ($isAjax) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Đã xảy ra lỗi khi xóa tài khoản!'
                ], 500);
            }

            AlertService::error('Đã xảy ra lỗi khi xóa tài khoản!');
            return redirect()->back();
        }
    }
}
