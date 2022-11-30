<div>
    <livewire:report::mailable.detail />
    <livewire:report::mailable.form />
    <div class="d-flex justify-content-between">
        @if (count($mailable_files) > 0)
        <div class="pr-2" style="max-width: 50%!important; flex: 0;">
            <h5>{{ __('report::messages.mailables_list') }}</h5>
            <ul class="list-group overflow-auto">
                @foreach ($mailable_files as $mailable)
                <li class="list-group-item d-flex justify-content-between ">
                    <button class="btn btn-primary bg-gradient btn-sm"
                        wire:click='$emit("createMailable", "{{ str($mailable)->replace("\\", "\\\\") }}")'>Add</button>
                    {{ $mailable }}
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="" style="flex: 1;">
            <div class="card ">
                <div class="card-body text-black" :key="time()">
                    <livewire:report::mailable.table />
                </div>
            </div>
        </div>
    </div>
</div>