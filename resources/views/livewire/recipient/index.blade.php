<div>
    <livewire:mailing::recipient.detail />
    <livewire:mailing::recipient.form />
    <div class="card ">
        <div class="card-body text-black" :key="time()">
            <livewire:mailing::recipient.table />
        </div>
    </div>
</div>