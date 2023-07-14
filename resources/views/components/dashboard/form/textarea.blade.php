@props([
    'name' , 'label' , 'value' => '' , 'rows' => '3'
])

<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="{{ $name }}">{{ $label }}</label>
    <div class="col-sm-10">
        <textarea id="{{ $name }}"
                  name="{{ $name }}"
                  rows="{{ $rows }}"
                  {{
                        $attributes->class([
                            'form-control',
                            'is-invalid' => $errors->has($name)
                        ])
                  }}
        >{{ old($name, $value) }}</textarea>
        @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>