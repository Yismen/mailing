<div>
    <livewire:report::mailable.detail />
    <livewire:report::mailable.form />
    <div class="row">
        <div class="col-sm-4">
            <h5>{{ __('Mailables List') }}</h5>
            <ul class="list-group overflow-auto">
                @foreach ($mailable_files as $mailable)
                @if(!$mailables->contains($mailable))
                <li class="list-group-item d-flex justify-content-between ">
                    <button class="btn btn-primary bg-gradient btn-sm"
                        wire:click='$emit("createMailable", "{{ str($mailable)->replace("\\", "\\\\") }}")'>Add</button>
                    {{ $mailable }}
                </li>
                @else
                {{-- <li class="list-group-item d-flex justify-content-between active">
                    {{ $mailable }}
                </li> --}}
                @endif

                @endforeach
            </ul>
        </div>
        <div class="col-sm-8">
            <div class="card ">
                <div class="card-body text-black" :key="time()">
                    <livewire:report::mailable.table />
                </div>
            </div>
        </div>
    </div>
</div>