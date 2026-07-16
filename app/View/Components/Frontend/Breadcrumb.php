<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component // Tạo Component Breadcrumb
{
    public array $items; // Biến truyền sang Blade

    public function __construct(array $items = [])
    {
        $this->items = $items; // Gán dữ liệu vào biến
    }

    public function render(): View|Closure|string
    {
        return view('components.frontend.breadcrumb'); // Hiển thị view của Component
    }
}