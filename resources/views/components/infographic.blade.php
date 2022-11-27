@props([
'type' => 'info',
'icon' => 'fas fa-cog',
'count',
])

<div {{ $attributes->merge([
    'class' => 'info-box'
    ]) }}>
    <span class="bg-{{ $type }} elevation-1 info-box-icon"><i class="{{ $icon }}"></i></span>
    <div class="info-box-content">
        <span class="info-box-text">{{ $slot }}</span>
        <span class="info-box-number">
            {{ $count }}
        </span>
    </div>

</div>