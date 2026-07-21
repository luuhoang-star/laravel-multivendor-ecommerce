<?php

namespace App\Services;

use App\Mail\GenericMail;
use Illuminate\Support\Facades\Mail;

class MailService
{
    // Hàm gửi email
    public static function send(
        string $to,      // Email người nhận
        string $subject, // Tiêu đề email
        string $body     // Nội dung email
    ): bool {

        // Gửi email đến người nhận
        Mail::to($to)
            ->send(new GenericMail($subject, $body));

        // Báo gửi thành công
        return true;
    }
}
