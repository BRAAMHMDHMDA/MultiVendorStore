@props([
    'type' => 'text', 'name', 'value' => '', 'label'=> ''
])

<div class="form-group">
    @if($label != '')
        <label for="{{ $name }}">{!! $label !!}</label>
    @endif
    <input
           type="{{ $type }}"
           id="{{ $name }}"
           name="{{ $name }}"
           value="{{ old($name, $value) }}"
            {{ $attributes->class([
                               'form-control',
                               'is-invalid' => $errors->has($name)
                              ])
            }}
    >
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

