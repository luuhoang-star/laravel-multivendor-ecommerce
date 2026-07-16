<div class="page-header breadcrumb-wrap"> <!-- Khung chứa breadcrumb -->
    <div class="container">
        <div class="breadcrumb">
            <!-- Duyệt từng phần tử trong mảng $items -->
            @foreach ($items as $item)
                <!-- Nếu KHÔNG phải phần tử cuối -->
                @if (!$loop->last)
                    <a href="{{ $item['url'] }}" rel="nofollow">
                        <i class="fi-rs-home mr-5"></i> <!-- Icon -->
                        {{ $item['label'] }} <!-- Hiển thị tên -->
                    </a>
                @else
                    <span>{{ $item['label'] }}</span> <!-- Nếu là phần tử cuối,chỉ hiển thị tên, không có link -->
                @endif
            @endforeach

        </div>
    </div>
</div>
