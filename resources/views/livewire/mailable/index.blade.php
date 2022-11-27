<div>
    <livewire:report::mailable.detail />
    <livewire:report::mailable.form />
    <div class="card ">
        <div class="card-body text-black" :key="time()">
            <livewire:report::mailable.table />
        </div>
    </div>
</div>