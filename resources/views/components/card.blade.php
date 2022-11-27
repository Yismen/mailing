@props([
'header',
'footer',
])

<div class="card">
    @if (isset($header))
    <h4 class="align-content-center border d-flex justify-content-between m-0 p-3">
        {{ $header }}
    </h4>
    @endif

    <div {{ $attributes->merge([
        'class' => 'card-body p-0'
        ]) }}>
        {{ $slot }}
    </div>

    @if (isset($footer))
    <div class="card-footer">
        {{ $footer }}
    </div>
    @endif
</div>