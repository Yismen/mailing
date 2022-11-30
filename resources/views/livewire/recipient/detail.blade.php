<div>

    <x-report::modal title="{{ __('report::messages.recipient') }} - {{ $recipient->name ?? '' }}"
        modal-name="RecipientDetails" event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ __('report::messages.name') }}:</th>
                    <td class="text-left">{{ $recipient->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('report::messages.email') }}:</th>
                    <td class="text-left">{{ $recipient->email ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('report::messages.title') }}:</th>
                    <td class="text-left">{{ $recipient->title ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <h5 class="p-2 border-top">{{ __('report::messages.mailables') }}</h5>
        @if ($recipient && $recipient->mailables->count() > 0)
        <table class="table table-striped table-sm px-2">
            <thead class="thead-inverse">
                <tr>
                    <th>{{ __('report::messages.name') }}</th>
                    <th>{{ __('report::messages.description') }}</th>
                    {{-- <th>{{ __('report::messages.title') }}</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($recipient->mailables as $mailable)
                <tr>
                    <td class="text-bold" scope="row">{{ $mailable->name }}</td>
                    <td title="{{ $mailable->description }}">{{ $mailable->shortDescription }}</td>
                    {{-- <td>{{ $mailable->title }}</td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm" wire:click='$emit("updateRecipient", {{ $recipient->id ?? '' }})'>{{
                __('Edit') }}</button>
        </x-slot>
    </x-report::modal>
</div>