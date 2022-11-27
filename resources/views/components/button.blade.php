@props([
'type' => 'submit',
'color' => 'primary',
])

<button type="submit" {{ $attributes->merge([
    'class' => "btn btn-{$color} bg-gradient"
    ]) }}>
    {{ $slot }}
</button>