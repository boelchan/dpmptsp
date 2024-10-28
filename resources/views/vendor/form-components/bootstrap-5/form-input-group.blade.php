<div class="mb-2">
    <x-form-label :label="$label" class="mt-2 fw-bold"/>

    <div {!! $attributes->merge(['class' => 'input-group'  . ($hasError($name) ? ' is-invalid' : '')]) !!}>
        {!! $slot !!}
    </div>

    {!! $help ?? null !!}

    @if($hasErrorAndShow($name))
        <x-form-errors :name="$name" />
    @endif
</div>
