<?php
namespace App\Services;

class AlertService {
    public static function updated($message = null) {
        notyf()->success($message ? $message : 'Cập nhật Profile thành công');
    }


    public static function created($message = null) {
        notyf()->success($message ? $message : 'Tạo thành công.');
    }

    public static function error($message = null) {
        notyf()->error($message ? $message : 'Có lỗi xảy ra, vui lòng thử lại.');
    }
}
