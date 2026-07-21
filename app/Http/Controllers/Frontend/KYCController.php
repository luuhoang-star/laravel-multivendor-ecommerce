<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use App\Models\KYC;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class KYCController extends Controller
{
    use FileUploadTrait;

    public function index(): View|RedirectResponse
    {
        if (
            auth()->user()->kyc?->status == 'pending'
            || auth()->user()->kyc?->status == 'approved'
        ) {
            return redirect()->route('vendor.dashboard');
        }

        return view('frontend.pages.kyc');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([

            'full_name' => [
                'required',
                'string',
                'max:255'
            ],

            'date_of_birth' => [
                'required',
                'date'
            ],

            'gender' => [
                'required',
                'max:255',
                'string'
            ],

            'address' => [
                'required',
                'max:255',
                'string'
            ],

            'document_type' => [
                'required',
                'max:255',
                'string'
            ],

            'document_scan_copy' => [
                'required',
                'mimes:jpg,jpeg,png,pdf,doc,docx',
                'max:10000'
            ]
        ]);
        if (KYC::where('user_id', auth()->id())->exists()) {

            $kyc = KYC::where('user_id', auth()->id())->first();
        } else {

            $kyc = new KYC();
        }

        $kyc->status = 'pending';


        $kyc->user_id = auth()->id();

        $kyc->full_name = $request->full_name;

        $kyc->date_of_birth = $request->date_of_birth;

        $kyc->gender = $request->gender;

        $kyc->address = $request->address;

        $kyc->document_type = $request->document_type;

        $filePath = $this->uploadPrivateFile(
            $request->file('document_scan_copy'),
            'kyc'
        );

        $kyc->document_scan_copy = $filePath;

        $kyc->save();

        AlertService::created('Thông tin KYC của bạn đã được gửi thành công! Vui lòng chờ quản trị viên phê duyệt..');

        return redirect()
            ->route('vendor.dashboard');
    }
}
