<div>
    @php

    $title = $editing ? join(" ", [ __('Edit'), __('Mailable'), $mailable->name]) : join(" ", [__('Create'),
    __('New'), __('Mailable') ])
    @endphp

    <x-report::modal modal-name="MailableForm" title="{{ $title }}" event-name="{{ $this->modal_event_name_form }}"
        :backdrop="false">

        <x-report::form :editing="$editing">
            <div class="p-3">
                <x-report::inputs.with-labels field="mailable.name">{{ __('Name') }}:
                </x-report::inputs.with-labels>

                <x-report::inputs.text-area field="mailable.description" :required="false">{{ __('Description') }}:
                </x-report::inputs.text-area>
            </div>
        </x-report::form>
    </x-report::modal>
</div>