@props([
    'type' => 'text', 'name', 'value' => ''
])

    <input type="{{ $type }}"
           name="{{ $name }}"
           id="{{ $name }}"
           value="{{ old($name, $value) }}"
           {{ $attributes->class([
                          'form-control',
                          'is-invalid' => $errors->has($name)
                         ])
           }}
    />
    {{$slot}}
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

