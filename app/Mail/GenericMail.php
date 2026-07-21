<?php

namespace App\Mail;

use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailable;

class GenericMail extends Mailable
{
    // Nội dung email
    public $body;

    // Khởi tạo dữ liệu cho email
    public function __construct($subject, $body)
    {
        $this->subject = $subject; // Lưu tiêu đề
        $this->body = $body;       // Lưu nội dung
    }

    // Thiết lập thông tin email (Subject, From, CC,...)
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject
        );
    }

    // Chọn Blade View và truyền dữ liệu sang View
    public function content(): Content
    {
        return new Content(
            view: 'mail.generic-mail',
            with: [
                'subject' => $this->subject, // Truyền tiêu đề
                'body' => $this->body        // Truyền nội dung
            ]
        );
    }
}
