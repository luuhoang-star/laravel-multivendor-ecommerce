@props(['id', 'name', 'image'])

<div {{ $attributes->merge([
    'id' => $id,
    'class' => 'ms-2 mb-3',
]) }}
    style="background-image: url('{{ $image ? asset($image) : '' }}'); background-size: cover;">
    <label for="image-upload" id="image-label">Chọn file</label>
    <input type="file" name="{{ $name }}" id="image-upload">
</div>
