@props(['type' => 'text', 'name', 'placeholder', 'required' => 'true', 'value'])
<input type="{{ $type }}" value="{{ $value }}" id="{{ $name }}" name="{{ $name }}" class="form-control"
    placeholder="{{ $placeholder }}" {{ $required == 'true' ? $required : '' }}>
@error($name)
    <small class="text-danger">{{ $message }}</small>
@enderror
