<div>
    <livewire:mailing::mailable.detail />
    <livewire:mailing::mailable.form />
    <div class="d-flex justify-content-between">
        @if (count($mailable_files) > 0)
        <div class="pr-2" style="max-width: 50%!important; flex: 0;">
            <h5>{{ __('mailing::messages.mailables_list') }}</h5>
            <ul class="list-group overflow-auto">
                @foreach ($mailable_files as $mailable)
                <li class="list-group-item d-flex justify-content-between ">
                    {{ $mailable }}
                    <button class="btn btn-primary bg-gradient btn-sm ml-2"
                        wire:click='$emit("createMailable", "{{ str($mailable)->replace("\\", "\\\\") }}")'>Add</button>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="" style="flex: 1;">
            <div class="card ">
                <div class="card-body text-black" :key="time()">
                    <livewire:mailing::mailable.table />
                </div>
            </div>
        </div>
    </div>
</div>