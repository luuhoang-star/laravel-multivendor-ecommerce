<?php

namespace App\Http\Requests\Admin;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool // authorize cho phép người dùng có đc phép gửi request hay không
    {
        return true;
    }

    /**
     * Get  the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array //rules nó validate dữ liệu đầu vào, nếu không hợp lệ thì sẽ trả về lỗi
    {
        return [
            'email' => ['required', 'string', 'email'], //bắt buộc nhập ,phải là chuỗi,đúng định dạng email
            'password' => ['required', 'string'], // ko đc để trống,phải là chuỗi
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited(); // kiểm tra xem có bị giới hạn tốc độ hay không, nếu quá số lần đăng nhập thất bại thì sẽ bị khóa tạm thời

        if (! Auth::guard('admin')->attempt(
            $this->only('email', 'password'), // lấy dữ liệu email và password từ request
            $this->boolean('remember') // lấy dữ liệu remember từ request, nếu có thì sẽ lưu thông tin đăng nhập trong cookie
        )) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(
            Str::lower($this->string('email')) . '|' . $this->ip()
        );
    }
}
