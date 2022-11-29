<div>

    <x-report::modal title="{{ __('Recipient') }} - {{ $recipient->name ?? '' }}" modal-name="RecipientDetails"
        event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ __('Name') }}:</th>
                    <td class="text-left">{{ $recipient->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Email') }}:</th>
                    <td class="text-left">{{ $recipient->email ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Title') }}:</th>
                    <td class="text-left">{{ $recipient->title ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm" wire:click='$emit("updateRecipient", {{ $recipient->id ?? '' }})'>{{
                __('Edit') }}</button>
        </x-slot>
    </x-report::modal>
</div>