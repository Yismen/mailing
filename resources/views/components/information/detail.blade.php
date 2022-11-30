@props(['information', 'modelName', 'modelId'])
<div class="border-top bg-gradient-info py-2">
    <h5 class="px-2">{{ __('report::messages.information') }}</h5>

    @if (isset($information) && $information )
    <table class="table table-striped table-inverse table-sm">
        <tbody class="thead-inverse">
            <tr>
                <th class="text-right">{{ __('report::messages.photo') }}:</th>
                <td class="text-left">
                    <a href="{{ '/storage/' . $information->photo_url ?? '' }}" target="_blank"
                        rel="noopener noreferrer">
                        <img src="{{ '/storage/' . $information->photo_url ?? '' }}" height="120" width="120"
                            class="img-thumbnail rounded-circle" alt="{{ $information->photo_url ?? '' }}">
                    </a>
                </td>
            </tr>
            <tr>
                <th class="text-right">{{ __('report::messages.phone') }}:</th>
                <td class="text-left">{{ $information->phone ?? '' }}</td>
            </tr>
            <tr>
                <th class="text-right">{{ __('report::messages.email') }}:</th>
                <td class="text-left">{{ $information->email ?? '' }}</td>
            </tr>
            <tr>
                <th class="text-right">{{ __('report::messages.address') }}:</th>
                <td class="text-left">{{ $information->address ?? '' }}</td>
            </tr>
            <tr>
                <th class="text-right">{{ __('report::messages.company_id') }}:</th>
                <td class="text-left">{{ $information->company_id ?? '' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="btn btn-sm btn-dark mx-2" wire:click='$emit("updateInformation", "{{ $information->id }}")'>{{
        __('Edit')
        }}
        {{
        __('Information') }}</div>
    @else
    <div class="alert alert-danger m-2" role="alert">
        <strong>In information added!</strong>
    </div>

    <div class="btn btn-sm btn-primary mx-2"
        wire:click='$emit("createInformation", "{{ str($modelName ?? '')->afterLast("\\") }}", "{{ $modelId }}" )'>
        {{ __('report::messages.=add') }} {{ __('report::messages.information') }}
    </div>
    @endif
</div>