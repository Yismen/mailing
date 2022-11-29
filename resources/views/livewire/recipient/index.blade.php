<div>
    <livewire:report::recipient.detail />
    <livewire:report::recipient.form />
    <div class="card ">
        <div class="card-body text-black" :key="time()">
            <livewire:report::recipient.table />
        </div>
    </div>
</div>