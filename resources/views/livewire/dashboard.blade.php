<div>
    <div class="row">
        <div class="col-md-3">
            <x-mailing::infographic type="info" count="{{ $mailables }}">
                Mailables
            </x-mailing::infographic>
        </div>
        <div class="col-md-3">
            <x-mailing::infographic type="fuchsia" count="{{ $registered }}">
                Mailable Registered
            </x-mailing::infographic>
        </div>
        <div class="col-md-3">
            <x-mailing::infographic type="gray-light" count="{{ $mailables ? ceil($registered / $mailables) *100: 0 }}%">
                Mailable Registered
            </x-mailing::infographic>
        </div>
        <div class="col-md-3">
            <x-mailing::infographic type="success" count="{{ $recipients }}">
                Recipients
            </x-mailing::infographic>
        </div>
    </div>
</div>