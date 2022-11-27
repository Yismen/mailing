<h4 class="align-items-center d-flex fs-5 justify-content-between">
    <div>
        {{ str($module)->headline()->plural() }} {{ __('Table') }}
        <span class="badge badge-pill bg-primary bg-gradient">{{ $count ?? 0 }}</span>
    </div>

    @include('report::tables.create', ['module' => $module ])
</h4>