@props([
'editing',
'footer' => true,
])

<form @if ($editing) wire:submit.prevent="update()" @else wire:submit.prevent="store()" @endif {{ $attributes->merge([
    'class' => 'needs-validation'
    ]) }} autocomplete="off">

    {{ $slot }}

    @if($footer)
    <div class="mt-3 border-top p-2">

        @if ($editing)
        <x-report::button type="submit" color="warning" class="btn-sm">
            {{ __('report::messages.update') }}
        </x-report::button>
        @else
        <x-report::button type="submit" color="primary" class="btn-sm">
            {{ __('report::messages.create') }}
        </x-report::button>
        @endif
    </div>
    @endif
</form>