<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    use FileUploadTrait;

    /**
     * Hiển thị trang hồ sơ cửa hàng của Vendor.
     */
    public function index(): View
    {
        $store = auth()->user()->store;

        return view('vendor-dashboard.store-profile.index', compact('store'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'logo' => ['nullable', 'image', 'max:2048'],
            'banner' => ['nullable', 'image', 'max:2048'],
            'name' => ['required', 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email'],
            'address' => ['nullable', 'string', 'max:255'],
            'short_description' => ['required', 'string'],
            'long_description' => ['nullable', 'string', 'max:2000'],
        ]);

        try {
            $store = auth()->user()->store;

            $data = $request->only([
                'name',
                'phone',
                'email',
                'address',
                'short_description',
                'long_description',
            ]);

            if ($request->hasFile('logo')) {
                $data['logo'] = $this->uploadFile($request->file('logo'), 'uploads', $store?->logo);
            }

            if ($request->hasFile('banner')) {
                $data['banner'] = $this->uploadFile($request->file('banner'), 'uploads', $store?->banner);
            }

            Store::updateOrCreate(
                ['seller_id' => auth()->id()],
                $data
            );

            AlertService::updated('Cập nhật hồ sơ cửa hàng thành công.');
        } catch (\Exception $e) {
            AlertService::error('Có lỗi xảy ra trong quá trình cập nhật, vui lòng thử lại!');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

