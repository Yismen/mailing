@props([
'question',
'render_as' => $question->optionType->render_as,
])


@foreach ($question->optionType->options as $index => $option)
@switch($render_as)

@case('multiple')
<div class=" custom-control custom-switch custom-radio custom-control-inline"
    wire:key='responses.{{ $question->id }}.option.{{ $option->id }}'>
    <input type="checkbox" id="{{ $question->slug() }}-{{ $loop->index }}" name="{{ $question->slug() }}"
        class="custom-control-input" wire:model.lazy='responses.{{ $question->id }}.option' value="{{ $option->id }}">

    <label class="custom-control-label form-check-label" for="{{ $question->slug() }}-{{ $loop->index }}">
        {{
        $option->name
        }}
    </label>
</div>
@break
@case('single')
<div class=" custom-control custom-switch custom-radio custom-control-inline"
    wire:key='responses.{{ $question->id }}.option.{{ $option->id }}'>
    <input type="radio" id="{{ $question->slug() }}-{{ $loop->index }}" name="{{ $question->slug() }}"
        class="custom-control-input" wire:model.lazy='responses.{{ $question->id }}.option' value="{{ $option->id }}">

    <label class="custom-control-label form-check-label" for="{{ $question->slug() }}-{{ $loop->index }}">
        {{
        $option->name
        }}
    </label>
</div>
@break

@case('open')
<div class="form-group">
    {{-- <label for="{{ $question->slug() }}-{{ $option->id }}  ">{{ $option->name }}</label> --}}
    <textarea class="form-control" name="{{ $question->slug() }}-{{ $option->id }} "
        id="{{ $question->slug() }}-{{ $option->id }}" rows="3"
        wire:model.lazy='responses.{{ $question->id }}.option.{{ $option->id }}'></textarea>
</div>
@break

@default
@endswitch

@endforeach