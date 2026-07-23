@props([
    'name',
    'image' => null,
    'imageUploadId' => 'image-upload',
    'imagePreviewId' => 'image-preview',
    'imageLabelId' => 'image-label',
])

@php
    $defaultAvatar = asset('defaults/avatar.png');
    $imageUrl = $image ? (str_starts_with($image, 'http') ? $image : asset($image)) : $defaultAvatar;
@endphp

<div id="{{ $imagePreviewId }}" 
     style="background-image: url('{{ $imageUrl }}'); background-size: cover; background-position: center;" 
     {{ $attributes->merge(['class' => 'image-preview mb-3']) }}>
    <label for="{{ $imageUploadId }}" id="{{ $imageLabelId }}">Chọn ảnh</label>
    <input type="file" name="{{ $name }}" id="{{ $imageUploadId }}" />
</div>
