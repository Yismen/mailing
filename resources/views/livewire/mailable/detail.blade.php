<div>

    <x-report::modal title="{{ __('Mailable') }} - {{ $mailable->name ?? '' }}" modal-name="MailableDetails"
        event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ __('Name') }}:</th>
                    <td class="text-left">{{ $mailable->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Description') }}:</th>
                    <td class="text-left">{{ $mailable->description ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <h5 class="p-2 border-top">{{ __('Recipients') }}</h5>
        @if ($mailable && $mailable->recipients)
        <table class="table table-striped table-sm px-2">
            <thead class="thead-inverse">
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Title') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mailable->recipients as $recipient)
                <tr>
                    <td scope="row">{{ $recipient->name }}</td>
                    <td>{{ $recipient->email }}</td>
                    <td>{{ $recipient->title }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm" wire:click='$emit("updateMailable", {{ $mailable->id ?? '' }})'>{{
                __('Edit') }}</button>
        </x-slot>
    </x-report::modal>
</div>