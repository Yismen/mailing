@props([
'field',
'required' => true,
])

@php
$id = rand();
@endphp
<div class="mb-3">
    <div class="custom-control custom-switch">
        <input type="checkbox" id="{{ $id }}" wire:model='{{ $field }}' {{ $attributes->class([
        'custom-control-input',
        'is-invalid' => $errors->has($field)
        ])->merge([])
        }}>
        <label class="custom-control-label" for="{{ $id }}">
            {{ $slot }}
        </label>
        <x-report::inputs.error :field="$field" />
    </div>
</div>