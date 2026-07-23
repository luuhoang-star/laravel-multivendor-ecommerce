<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\KYC;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KYCController extends Controller
{
    use FileUploadTrait;

    /**
     * Hiển thị trang đăng ký KYC.
     */
    public function index(): View|RedirectResponse
    {
        $status = auth()->user()->kyc?->status;

        if (in_array($status, ['pending', 'approved'])) {
            return redirect()->route('vendor.dashboard');
        }

        return view('frontend.pages.kyc');
    }

    /**
     * Gửi hoặc cập nhật yêu cầu xác thực KYC.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'document_type' => ['required', 'string', 'max:255'],
            'document_scan_copy' => ['required', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:10000'],
        ]);

        $oldPath = auth()->user()->kyc?->document_scan_copy;

        $filePath = $this->uploadPrivateFile(
            $request->file('document_scan_copy'),
            'kyc',
            $oldPath
        );

        KYC::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'full_name' => $validatedData['full_name'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'gender' => $validatedData['gender'],
                'address' => $validatedData['address'],
                'document_type' => $validatedData['document_type'],
                'document_scan_copy' => $filePath,
                'status' => 'pending',
            ]
        );

        AlertService::created('Thông tin KYC của bạn đã được gửi thành công! Vui lòng chờ quản trị viên phê duyệt..');

        return redirect()->route('vendor.dashboard');
    }
}
