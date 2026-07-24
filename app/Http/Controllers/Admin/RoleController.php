<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Permission as PermissionConstant;
use App\Constants\Role as RoleConstant;
use App\Http\Controllers\Controller;
use App\Services\AlertService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller implements HasMiddleware
{
    /**
     * Kiểm tra quyền truy cập vào toàn bộ controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:' . PermissionConstant::MANAGE_ROLE),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $roles = Role::where('guard_name', RoleConstant::GUARD_ADMIN)
            ->withCount(['permissions', 'users'])
            ->get();

        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Nhóm quyền theo chức năng để hiển thị trên giao diện
        $permissions = Permission::where('guard_name', RoleConstant::GUARD_ADMIN)
            ->get()
            ->groupBy('group_name');

        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'role' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'permissions' => ['required', 'array'],
        ], [
            'role.required' => 'Vui lòng nhập tên vai trò.',
            'role.unique' => 'Tên vai trò này đã tồn tại.',
            'permissions.required' => 'Vui lòng chọn ít nhất một quyền hạn.',
        ]);

        $role = Role::create([
            'name' => $request->role,
            'guard_name' => RoleConstant::GUARD_ADMIN,
        ]);

        $role->syncPermissions($request->permissions);

        AlertService::created('Tạo vai trò mới thành công!');

        return to_route('admin.role.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): View|RedirectResponse
    {
        // Không cho phép chỉnh sửa vai trò hệ thống
        if ($role->name === RoleConstant::SUPER_ADMIN) {
            AlertService::error('Không thể cập nhật vai trò Super Admin!');
            return redirect()->route('admin.role.index');
        }

        // Nhóm quyền theo chức năng để hiển thị trên giao diện
        $permissions = Permission::where('guard_name', RoleConstant::GUARD_ADMIN)
            ->get()
            ->groupBy('group_name');

        return view('admin.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        // Không cho phép chỉnh sửa vai trò hệ thống
        if ($role->name === RoleConstant::SUPER_ADMIN) {
            AlertService::error('Không thể cập nhật vai trò Super Admin!');
            return redirect()->route('admin.role.index');
        }

        $request->validate([
            'role' => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id],
            'permissions' => ['required', 'array'],
        ], [
            'role.required' => 'Vui lòng nhập tên vai trò.',
            'role.unique' => 'Tên vai trò này đã tồn tại.',
            'permissions.required' => 'Vui lòng chọn ít nhất một quyền hạn.',
        ]);

        $role->update(['name' => $request->role]);

        $role->syncPermissions($request->permissions);

        AlertService::updated('Cập nhật vai trò thành công!');

        return to_route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): JsonResponse|RedirectResponse
    {
        $isAjax = request()->ajax() || request()->wantsJson() || request()->header('X-Requested-With') === 'XMLHttpRequest';

        // Không cho phép xóa vai trò hệ thống
        if ($role->name === RoleConstant::SUPER_ADMIN) {
            if ($isAjax) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Không thể xóa vai trò Super Admin!'
                ], 400);
            }
            AlertService::error('Không thể xóa vai trò Super Admin!');
            return redirect()->back();
        }

        // Kiểm tra xem có tài khoản Admin nào đang giữ vai trò này hay không
        if ($role->users()->count() > 0) {
            $msg = 'Không thể xóa vai trò này vì đang có tài khoản Admin sử dụng!';
            if ($isAjax) {
                return response()->json([
                    'status' => 'error',
                    'message' => $msg
                ], 400);
            }
            AlertService::error($msg);
            return redirect()->back();
        }

        // Đảm bảo toàn bộ quá trình xóa thành công hoặc hoàn tác nếu có lỗi
        DB::beginTransaction();
        try {
            // Detach permissions from role
            $role->syncPermissions([]);

            // Delete role
            $role->delete();

            DB::commit();

            AlertService::deleted('Xóa vai trò thành công!');

            if ($isAjax) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Xóa vai trò thành công!'
                ]);
            }

            return to_route('admin.role.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Role Delete Error: ' . $th->getMessage());

            if ($isAjax) {
                return response()->json([
                    'status' => 'error',
                    'message' => $th->getMessage()
                ], 500);
            }

            AlertService::error('Đã xảy ra lỗi khi xóa vai trò!');
            return redirect()->back();
        }
    }
}
