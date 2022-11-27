@props([
'type' => 'primary',
'amount',
])

<div class="progress">
    <div class="progress-bar progress-bar-striped bg-{{ $type }}" role="progressbar" style="width: {{ $amount }}%"
        aria-valuenow="{{ $amount }}" aria-valuemin="0" aria-valuemax="100">
        {{ $amount }}%
    </div>
</div>