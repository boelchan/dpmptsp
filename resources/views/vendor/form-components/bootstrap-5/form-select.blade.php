@if($floating) <div class="form-floating mb-1"> @endif

    @if(!$floating)
        <x-form-label :label="$label" :for="$attributes->get('id') ?: $id()" class="mt-2 fw-bold" />
    @endif

    <select
        @if($isWired())
            wire:model{!! $wireModifier() !!}="{{ $name }}"
        @endif

        name="{{ $name }}"

        @if($multiple)
            multiple
        @endif

        @if($placeholder)
            placeholder="{{ $placeholder }}"
        @endif

        @if($label && !$attributes->get('id'))
            id="{{ $id() }}"
        @endif

        {!! $attributes->merge(['class' => 'form-select' . ($hasError($name) ? ' is-invalid' : '')]) !!}
    >

        @if($placeholder)
            <option value="" disabled @if($nothingSelected()) selected="selected" @endif>
                {{ $placeholder }}
            </option>
        @endif

        @forelse($options as $key => $option)
            <option value="{{ $key }}" @if($isSelected($key)) selected="selected" @endif>
                {{ $option }}
            </option>
        @empty
            {!! $slot !!}
        @endforelse
    </select>

    @if($floating)
        <x-form-label :label="$label" :for="$attributes->get('id') ?: $id()" />
    @endif


{!! $help ?? null !!}

@if($hasErrorAndShow($name))
    <x-form-errors :name="$name" />
@endif
@if($floating) </div> @endif
