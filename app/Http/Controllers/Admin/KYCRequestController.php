<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KYC;
use App\Services\MailService;
use App\Services\AlertService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class KYCRequestController extends Controller
{
    public function index(): View
    {
        $kycRequests = KYC::with('user')->paginate(25);

        return view('admin.kyc.index', compact('kycRequests'));
    }

    public function pending(): View
    {
        $kycRequests = KYC::with('user')->where('status', 'pending')->paginate(25);

        return view('admin.kyc.pending', compact('kycRequests'));
    }

    public function rejected(): View
    {
        $kycRequests = KYC::with('user')->where('status', 'rejected')->paginate(25);

        return view('admin.kyc.rejected', compact('kycRequests'));
    }

    public function show(KYC $kycRequest): View
    {
        return view('admin.kyc.show', compact('kycRequest'));
    }

    public function download(KYC $kycRequest): StreamedResponse
    {
        return Storage::disk('local')->download($kycRequest->document_scan_copy);
    }

    public function update(Request $request, KYC $kycRequest)
    {
        $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
        ], [
            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ]);


        if ($request->status === 'approved') {
            MailService::send(
                to: $kycRequest->user->email,
                subject: 'Yêu cầu xác minh KYC của bạn đã được phê duyệt',
                body: 'Chúc mừng! Yêu cầu xác minh danh tính (KYC) của bạn trên hệ thống ShopX đã được phê duyệt thành công. Bây giờ bạn đã có thể sử dụng đầy đủ các tính năng dành cho cửa hàng của mình.'
            );
        } elseif ($request->status === 'rejected') {
            MailService::send(
                to: $kycRequest->user->email,
                subject: 'Yêu cầu xác minh KYC của bạn đã bị từ chối',
                body: 'Rất tiếc! Yêu cầu xác minh danh tính (KYC) của bạn trên hệ thống ShopX đã bị từ chối. Vui lòng kiểm tra lại thông tin, tài liệu và gửi lại yêu cầu mới.'
            );
        }

        $kycRequest->update(['status' => $request->status]);

        AlertService::updated('Cập nhật trạng thái KYC thành công!');

        return redirect()->route('admin.kyc.index');
    }
}
