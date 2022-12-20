@props([
'field',
'required' => true,
'options',
])
<div class="mb-3">
    <x-mailing::inputs.label :field="$field" :required="$required" :label="$slot" />

    <select wire:model='{{ $field }}' id="{{ $field }}" {{ $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($field)
        ])->merge([
        ]) }}
        >
        <option></option>
        @foreach ($options as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>

    <x-mailing::inputs.error :field="$field" />
</div>