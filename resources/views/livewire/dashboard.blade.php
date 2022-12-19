<div>
    <div class="row">
        <div class="col-md-3">
            <x-report::infographic type="info" count="{{ $mailables }}">
                Mailables
            </x-report::infographic>
        </div>
        <div class="col-md-3">
            <x-report::infographic type="fuchsia" count="{{ $registered }}">
                Mailable Registered
            </x-report::infographic>
        </div>
        <div class="col-md-3">
            <x-report::infographic type="gray-light" count="{{ $mailables ? ceil($registered / $mailables) *100: 0 }}%">
                Mailable Registered
            </x-report::infographic>
        </div>
        <div class="col-md-3">
            <x-report::infographic type="success" count="{{ $recipients }}">
                Recipients
            </x-report::infographic>
        </div>
    </div>
</div>