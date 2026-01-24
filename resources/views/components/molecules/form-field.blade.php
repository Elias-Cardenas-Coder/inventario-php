@props(['label' => '', 'id' => null, 'type' => 'text', 'placeholder' => '', 'required' => false, 'value' => ''])

<div class="mb-4">
    @if($label)
        <x-atoms.label :label="$label" :id="$id" :required="$required" />
    @endif

    @if($type === 'textarea')
        <x-atoms.textarea
            :id="$id"
            :placeholder="$placeholder"
            :required="$required"
            {{ $attributes }}
        >{{ $value }}</x-atoms.textarea>
    @elseif($type === 'select')
        <x-atoms.select
            :id="$id"
            :required="$required"
            {{ $attributes }}
        />
    @else
        <x-atoms.input
            :type="$type"
            :id="$id"
            :placeholder="$placeholder"
            :required="$required"
            :value="$value"
            {{ $attributes }}
        />
    @endif
</div>
