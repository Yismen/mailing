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

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm" wire:click='$emit("updateMailable", {{ $mailable->id ?? '' }})'>{{
                __('Edit') }}</button>
        </x-slot>
    </x-report::modal>
</div>