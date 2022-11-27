<a href="#" class="btn btn-warning btn-sm" wire:click.prevent='$emit("update{{ $this->module }}", "{{ $row->id }}")'>{{
    __('Edit') }}</a>