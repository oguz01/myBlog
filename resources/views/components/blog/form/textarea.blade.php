@props(['name', 'placeholder', 'value'])
<textarea id="{{ $name }}" name="{{ $name }}" cols="30" rows="3" class="form-control"
    placeholder="{{ $placeholder }}" required>{{ $value }}</textarea>
@error($name)
    <small class="text-danger">{{ $message }}</small>
@enderror
