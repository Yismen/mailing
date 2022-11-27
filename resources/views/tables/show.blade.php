<a href="#" class="btn btn-secondary btn-sm" wire:click.prevent='$emit("show{{ $this->module }}", "{{ $row->id }}")'>{{
    __('View') }}</a>