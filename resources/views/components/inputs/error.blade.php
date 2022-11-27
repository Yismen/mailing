@props([
'field',
'textClass' => 'invalid-feedback'
])

@error($field)
<div class="{{ $textClass }}">
    {{ $message }}
</div>
@enderror