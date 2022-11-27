@props([
'label',
'field',
'required' => true
])
<label for="{{ $field }}" class="form-label">
    {{ $label }}
    @if ($attributes->has('required') || $required)
    <span class="text-sm text-danger" title="Required">**</span>
    @endif
</label>