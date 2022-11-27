@props([
'type' => 'text',
'required' => true,
'field',
])
<div class="mb-3">
    <x-report::inputs.label :field="$field" :required="$required" :label="$slot" />

    <input type="{{ $type }}" id="{{ $field }}" aria-describedby="{{ $field }}Help" wire:model='{{ $field }}' {{
        $attributes->class([
    'form-control',
    'is-invalid' => $errors->has($field)
    ])->merge([
    ]) }}
    >

    <x-report::inputs.error :field="$field" />
</div>