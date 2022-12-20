<div>
    @php

    $title = $editing ? join(" ", [ __('Edit'), __('Recipient'), $recipient->name]) : join(" ", [__('Create'),
    __('New'), __('Recipient') ])
    @endphp

    <x-mailing::modal modal-name="RecipientForm" title="{{ $title }}" event-name="{{ $this->modal_event_name_form }}"
        :backdrop="false">

        <x-mailing::form :editing="$editing">
            <div class="p-3">
                <x-mailing::inputs.with-labels field="recipient.name">{{ __('mailing::messages.name') }}:
                </x-mailing::inputs.with-labels>

                <x-mailing::inputs.with-labels field="recipient.email" type="email">{{ __('mailing::messages.email') }}:
                </x-mailing::inputs.with-labels>

                <x-mailing::inputs.with-labels field="recipient.title" :required="false">{{ __('mailing::messages.title')
                    }}:
                </x-mailing::inputs.with-labels>

                <h5 class="border-top pt-1">{{ __('mailing::messages.mailables') }}</h5>
                @foreach ($mailables_list as $mailable_id => $mailable_name)
                <x-mailing::inputs.switch field="mailables" value="{{ $mailable_id }}"
                    wire:key='mailable{{ $mailable_id }}'>
                    {{
                    $mailable_name }}
                </x-mailing::inputs.switch>
                @endforeach
            </div>
        </x-mailing::form>
    </x-mailing::modal>
</div>