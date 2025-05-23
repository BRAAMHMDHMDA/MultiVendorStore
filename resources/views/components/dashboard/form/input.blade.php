@props([
    'type' => 'text', 'name', 'value' => '', 'label'
])


<div class="row">
    @isset($label)
        <label class="col-sm-2 col-form-label" for="{{ $name }}">{{ $label }}</label>
        <div class="col-sm-9">
            @else
                <div class="col-sm-12">

                    @endisset
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
    </div>
</div>

