<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUploadTrait
{
    /**
     * Upload file công khai và xóa file cũ (nếu có)
     */
    public function uploadFile(
        UploadedFile $file,
        ?string $path = 'uploads',      // Thư mục lưu file
        ?string $oldPath = null         // Đường dẫn file cũ
    ): ?string {

        // Kiểm tra file upload hợp lệ
        if (!$file->isValid()) {
            return null;
        }

        // Danh sách file không được xóa
        $ignorePath = [
            'defaults/avatar.png',
            'defaults/shop.png',
            'defaults/banner.png'
        ];

        // Xóa file cũ nếu tồn tại và không nằm trong danh sách bỏ qua
        if (
            $oldPath &&
            File::exists(public_path($oldPath)) &&
            !in_array($oldPath, $ignorePath)
        ) {
            File::delete(public_path($oldPath));
        }

        // Tạo tên file ngẫu nhiên
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        // Lưu file vào thư mục public
        $file->move(public_path($path), $filename);

        // Trả về đường dẫn để lưu vào database
        return $path . '/' . $filename;
    }

    /**
     * Upload file riêng tư (Private Storage) và xóa file cũ (nếu có)
     */
    public function uploadPrivateFile(
        UploadedFile $file,
        ?string $path = 'uploads',      // Thư mục lưu file riêng tư
        ?string $oldPath = null         // Đường dẫn file cũ trong storage private
    ): ?string {
        if (!$file->isValid()) {
            return null;
        }

        // Xóa file private cũ nếu tồn tại
        if ($oldPath && Storage::disk('local')->exists($oldPath)) {
            Storage::disk('local')->delete($oldPath);
        }

        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        return $file->storeAs($path, $filename, 'local');
    }
}
