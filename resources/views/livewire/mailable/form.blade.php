<div>
    @php

    $title = $editing ? join(" ", [ __('Edit'), __('Mailable'), $mailable->name]) : join(" ", [__('Create'),
    __('New'), __('Mailable') ])
    @endphp

    <x-mailing::modal modal-name="MailableForm" title="{{ $title }}" event-name="{{ $this->modal_event_name_form }}"
        :backdrop="false">

        <x-mailing::form :editing="$editing">
            <div class="p-3">
                <x-mailing::inputs.with-labels field="mailable.name">{{ __('mailing::messages.name') }}:
                </x-mailing::inputs.with-labels>
                <x-mailing::inputs.switch field="mailable.active">{{ __('mailing::messages.active') }}:
                </x-mailing::inputs.switch>

                <x-mailing::inputs.text-area field="mailable.description" :required="false">
                    {{__('mailing::messages.description') }}:
                </x-mailing::inputs.text-area>

                <h5 class="border-top pt-1">{{ __('mailing::messages.recipients') }}</h5>
                @foreach ($recipients_list as $recipient_id => $recipient_name)
                <x-mailing::inputs.switch field="recipients" value="{{ $recipient_id }}"
                    wire:key='recipient{{ $recipient_id }}'>{{ $recipient_name }}
                </x-mailing::inputs.switch>
                @endforeach
            </div>
        </x-mailing::form>
    </x-mailing::modal>
</div>