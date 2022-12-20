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
        <x-mailing::button type="submit" color="warning" class="btn-sm">
            {{ __('mailing::messages.update') }}
        </x-mailing::button>
        @else
        <x-mailing::button type="submit" color="primary" class="btn-sm">
            {{ __('mailing::messages.create') }}
        </x-mailing::button>
        @endif
    </div>
    @endif
</form>