<div>
    @php

    $title = $editing ? join(" ", [ __('Edit'), __('Recipient'), $recipient->name]) : join(" ", [__('Create'),
    __('New'), __('Recipient') ])
    @endphp

    <x-report::modal modal-name="RecipientForm" title="{{ $title }}" event-name="{{ $this->modal_event_name_form }}"
        :backdrop="false">

        <x-report::form :editing="$editing">
            <div class="p-3">
                <x-report::inputs.with-labels field="recipient.name">{{ __('Name') }}:
                </x-report::inputs.with-labels>

                <x-report::inputs.with-labels field="recipient.email" type="email">{{ __('Email') }}:
                </x-report::inputs.with-labels>

                <x-report::inputs.with-labels field="recipient.title" :required="false">{{ __('Title') }}:
                </x-report::inputs.with-labels>
            </div>
        </x-report::form>
    </x-report::modal>
</div>