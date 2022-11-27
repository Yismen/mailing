@props([
'field',
'required' => true,
'options',
])
<div class="mb-3">
    <div {{ $attributes->class([
        'form-check form-check-inline',
        'is-invalid' => $errors->has($field)
        ])->merge([])
        }}
        >
        <label class="form-check-label @error($field) is-invalid @enderror">
            <input class=" form-check-input" type="checkbox" wire:model='{{ $field }}'> {{ $slot }}
            <x-report::inputs.error :field="$field" />
        </label>
    </div>

</div>