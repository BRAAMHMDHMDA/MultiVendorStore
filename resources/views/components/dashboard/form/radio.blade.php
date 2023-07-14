@props([
     'name', 'label' , 'value' , 'old_option'
])


<input
        type="radio"
        name="{{$name}}"
        value="{{$value}}"
        id="{{$value}}"
        @checked(old($name, $old_option) == $value)
        {{ $attributes->class([
                              'form-check-input',
                              'is-invalid' => $errors->has($name)
                             ])
        }}
/>
<label class="form-check-label" for="{{$value}}"> {{ $label }}</label>
@error($name)
        <div class="invalid-feedback">
                {{ $message }}
        </div>
@enderror